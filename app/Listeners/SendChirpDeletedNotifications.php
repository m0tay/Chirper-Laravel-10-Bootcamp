<?php

namespace App\Listeners;

use App\Events\ChirpDeleted;
use App\Models\User;
use App\Notifications\DeletedChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpDeletedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpDeleted $event): void
    {
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new DeletedChirp($event->chirp));
        }
    }
}
