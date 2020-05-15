<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $news_site_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $url_to_image
 * @property string $published_at
 * @property string $content
 * @property int $volume
 * @property string $author
 * @property string $created_at
 * @property string $updated_at
 * @property NewsSite $newsSite
 * @property Comment[] $comments
 * @property User[] $favorites
 * @property Folder[] $folders
 * @property User[] $histories
 */
class Article extends Model
{

    // １分間に読む文字数
    public $countsPerMin = 500;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['news_site_id', 'title', 'description', 'url', 'url_to_image', 'published_at', 'content', 'volume', 'author'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newsSite()
    {
        return $this->belongsTo('App\NewsSite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites', 'article_id', 'user_id')->withPivot('stars')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function folders()
    {
        return $this->belongsToMany('App\Folder', 'folder_article', 'article_id', 'folder_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function histories()
    {
        return $this->belongsToMany('App\User', 'histories', 'article_id', 'user_id')->withTimestamps();
    }


    // 取得するコメント数	commentsデータを最新のものから取得	コメントデータ
    public function newestComments(int $length)
    {
        return $this->comments()->limit($length)->latest()->get();
    }

    // 記事のURL 又は ID	URLかIDから該当する記事データを取得	記事データ
    public function getArticle($key)
    {
        if ($this->isURL($key)) {
            return $this->where('url', $key)->first();
        } elseif (is_int($key)) {
            return $this->find($key);
        }

        return false;
    }
    
    protected function isURL($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }


    // 記事データ	データから読み終えるまでの時間を	時間値
    // 計算（分単位）
    // 500文字／分　で計算
    public function calcReadingLength($article)
    {
        $length = mb_strlen($article);

        return round($length / $this->countsPerMin);
    }
}
