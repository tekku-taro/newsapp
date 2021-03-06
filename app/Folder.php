<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Article[] $articles
 */
class Folder extends Model
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
    protected $fillable = ['name', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article', 'folder_article', 'folder_id', 'article_id')->withTimestamps();
    }

    // 記事ID	該当記事がフォルダ内にあるかチェック	boolean
    public function hasArticle(int $articleId)
    {
        return $this->articles()->where('article_id', $articleId)->exists();
    }

    // search_key, id	検索キーとIDからフォルダに保存した	記事データ
    // 記事データを取得
    public function getClippings(string $searchKey = null)
    {
        return $this->articles()->with('folders')->where('title', 'like', '%'.$searchKey.'%');
    }

    public function addId($articles)
    {
        foreach ($articles as $key => $article) {
            $articles[$key]->folderId = $this->id;
        }
        return $articles;
    }

    public function addIdIfExist($articles)
    {
        foreach ($articles as $idx => $article) {
            if ($this->hasArticle($article->id)) {
                $articles[$idx]->folderId = $this->id;
            }
        }
        return $articles;
    }

    // id, article_id,old_id	既にフォルダにあるか確認	boolean
    // 無ければ保存する
    // 他のフォルダにあれば移動する
    public function clipArticle(int $articleId, int $oldId = null)
    {
        if (!$this->hasArticle($articleId)) {
            $this->deleteInOtherFolder($articleId, $oldId);
            $this->articles()->attach($articleId);
        }
        return true;
    }

    // 他のフォルダをチェック、あれば削除
    protected function deleteInOtherFolder($articleId, $oldId)
    {
        if (empty($oldId)) {
            return false;
        }
        $folder = $this->find($oldId);
        $article = $folder->articles()->where('article_id', $articleId)->first();
        if ($article) {
            $folder->articles()->detach($articleId);
            return true;
        }

        return false;
    }

    // id, article_id	既にフォルダにあるか確認	boolean
    // あれば削除する
    public function deleteArticle(int $articleId)
    {
        if ($this->hasArticle($articleId)) {
            $this->articles()->detach($articleId);
            return true;
        } else {
            return false;
        }
    }
}
