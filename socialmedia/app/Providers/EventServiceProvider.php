<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRoleUpdated;
use App\Listeners\UpdateUserRoleListener;
use App\Events\PostLiked;
use App\Listeners\UpdatePostLikesCount;
use App\Events\PostDisliked;
use App\Listeners\UpdatePostDislikedCount;
use App\Events\NewMessage;
use App\Listeners\ProcessNewMessage;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRoleUpdated::class => [
            UpdateUserRoleListener::class,
        ],
        PostLiked::class => [
            UpdatePostLikesCount::class,
        ],
        PostDisliked::class => [
            UpdatePostDislikedCount::class,
        ],
        NewMessage::class => [
            ProcessNewMessage::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Tutaj możesz dodawać niestandardowe ustawienia związane z eventami
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
