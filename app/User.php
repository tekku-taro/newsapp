<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $note
 * @property boolean $comment_to_public
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Comment[] $comments
 * @property Folder[] $folders
 * @property Article[] $favorites
 * @property Article[] $histories
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'note', 'comment_to_public'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folders()
    {
        return $this->hasMany('App\Folder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Article', 'favorites', 'user_id', 'article_id')->withPivot('stars')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function histories()
    {
        return $this->belongsToMany('App\Article', 'histories', 'user_id', 'article_id')->withTimestamps();
    }

    // 記事ID	favorite pivotから☆評価値を取得	☆評価数値
    public function getFavoriteScore($articleId)
    {
        $favorite = $this->favorites()->where('article_id', $articleId)->first();

        if ($favorite) {
            return $favorite->pivot->stars;
        }
        return null;
    }

    // ユーザのフォルダに記事があるか、あればフォルダIDを追加
    public function getFolderId($articleId)
    {
        $folders = $this->folders()->get();

        foreach ($folders as $key => $folder) {
            if ($folder->hasArticle($articleId)) {
                return $folder->id;
            }
        }
        return null;
    }

    // 記事ID,☆評価数値	☆評価数値をfavorites pivotに保存	boolean
    public function addFavorite(int $articleId, int $stars)
    {
        if ($this->is_liking($articleId)) {
            $this->favorites()->updateExistingPivot($articleId, ['stars' => $stars]);
        } else {
            $this->favorites()->attach($articleId, ['stars'=>$stars]);
        }
        
        return true;
    }

    protected function is_liking(int $articleId)
    {
        return $this->favorites()->where('article_id', $articleId)->exists();
    }

    // 記事ID	favorites pivotから削除	boolean
    public function removeFavorite(int $articleId)
    {
        $this->favorites()->detach($articleId);
        return true;
    }

    // 記事ID, title, body	comments pivotに保存	boolean
    public function createComment(int $articleId, string $title, string $body)
    {
        $saveData = [
            'title'=>$title,
            'body'=>$body,
            'article_id'=>$articleId
        ];

        return $this->comments()->create($saveData);
    }

    // 取得する履歴数	histories pivotから履歴データと	履歴データと
    // Articleモデルを取得	Articleモデル
    public function newestHistories(int $length)
    {
        return $this->histories()->orderBy('pivot_created_at', 'desc')->take($length)->get();
    }

    //記事閲覧履歴をhistoriesテーブルに保存
    public function addHistory(int $articleId)
    {
        if ($this->in_history($articleId)) {
            $this->histories()->updateExistingPivot($articleId, ['created_at' => Carbon::now()]);
        } else {
            $this->histories()->attach($articleId);
        }
        return true;
    }

    protected function in_history(int $articleId)
    {
        return $this->histories()->where('article_id', $articleId)->exists();
    }
}
