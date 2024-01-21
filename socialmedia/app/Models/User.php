<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticatableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'blocked',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Get the posts liked by the user.
     *
     * @return BelongsToMany
     */
    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    /**
     * Block the user.
     */
    public function block()
    {
        $this->update(['blocked' => true]);
    }

    /**
     * Unblock the user.
     */
    public function unblock()
    {
        $this->update(['blocked' => false]);
    }
    /**
     * Add user to group
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    /**
     * Adding posts liked by user to database
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
