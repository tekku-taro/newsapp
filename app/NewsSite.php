<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $country_id
 * @property string $name
 * @property string $url
 * @property string $details
 * @property string $source
 * @property int $pagesize
 * @property int $page
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property Country $country
 * @property Article[] $articles
 */
class NewsSite extends Model
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
    protected $fillable = ['category_id', 'country_id', 'name', 'url', 'details', 'source', 'pagesize', 'page'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
