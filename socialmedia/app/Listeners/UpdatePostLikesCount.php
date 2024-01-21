<?php

namespace App\Listeners;

use App\Events\PostLiked;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePostLikesCount implements ShouldQueue
{
    public function handle(PostLiked $event)
    {
        $post = $event->post;
        $post->update([
            'likes_count' => $post->likedByUsers()->count(),
        ]);
    }
}
