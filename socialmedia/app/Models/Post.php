<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'likes_count', 'dislikes_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function addMedia($path)
    {
        return $this->media()->create(['path' => $path]);
    }

    public function getImagesAttribute()
    {
        return $this->media->pluck('path');
    }
}
