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
}
