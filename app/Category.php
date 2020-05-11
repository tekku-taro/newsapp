<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $name_jp
 * @property string $created_at
 * @property string $updated_at
 * @property NewsSite[] $newsSites
 */
class Category extends Model
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
    protected $fillable = ['name', 'name_jp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newsSites()
    {
        return $this->hasMany('App\NewsSite');
    }
}
