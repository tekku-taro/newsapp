<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property Article $article
 * @property User $user
 */
class Comment extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'article_id', 'title', 'body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // コメントID	commentsから削除	boolean
    public function deleteComment(int $commentId)
    {
        $comment = $this->find($commentId);

        return $comment->delete();

    }

    // 記事ID	comments からコメントデータと	コメントデータと
	// ユーザモデルを取得	ユーザモデル
    public function getComments(int $articleId)
    {
        $comments = $this->with('user')->where('article_id',$articleId)->get();

        return $comments;

    }
  

}
