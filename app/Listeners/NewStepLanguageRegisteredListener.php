<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewStepLanguageRegisteredEvent;
use App\Notifications\NewStepLanguageRegisteredNotification;
use Illuminate\Support\Facades\Notification;

class NewStepLanguageRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewStepLanguageRegisteredEvent $event)
    {
        $users = \User::all(); //Users To Send Emails
        Notification::send($users,new NewStepLanguageRegisteredNotification($event->stepByLanguageOrFramework));
    }
}
