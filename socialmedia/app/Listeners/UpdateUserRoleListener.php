<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User; // Dodaj import modelu User

class UpdateUserRoleListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // Konstruktor, możesz dodać jakieś inicjalizacje
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\UserRoleUpdated $event
     */
    public function handle($event): void
    {
        // Zaktualizuj rolę użytkownika w bazie danych lub wykonaj inne operacje
        $user = $event->user; // Pobierz użytkownika z zdarzenia
        $user->save(); // Przykładowa operacja - można dostosować do swoich potrzeb

        // Dodaj kod obsługi zdarzenia, np. zapis do bazy danych, aktualizacja cache itp.
    }
}
