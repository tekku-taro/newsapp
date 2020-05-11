<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property NewsSite[] $newsSites
 */
class Country extends Model
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
    protected $fillable = ['name', 'code'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newsSites()
    {
        return $this->hasMany('App\NewsSite');
    }
}
