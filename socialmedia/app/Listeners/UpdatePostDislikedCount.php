<?php

namespace App\Listeners;

use App\Events\PostLiked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePostDislikedCount
{
    public function handle(PostLiked $event)
    {
        $post = $event->post;
        $post->update([
            'dislikes_count' => $post->likedByUsers()->count(),
        ]);
    }
}
