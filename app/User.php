<?php

namespace App;

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
        return $this->belongsToMany('App\Article', 'favorites', 'user_id', 'article_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function histories()
    {
        return $this->belongsToMany('App\Article', 'histories', 'user_id', 'article_id')->withTimestamps();
    }
}
