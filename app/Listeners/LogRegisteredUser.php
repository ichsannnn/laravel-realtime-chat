<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewUserEvent;

class LogRegisteredUser
{
    public function __construct()
    {
        //
    }

    /**
     *
     * Listen to RegisteredUser event
     * and then send the event value to other
     * event that connected to broadcasting
     *
     */

    public function handle($event)
    {
        broadcast(new NewUserEvent($event->user));
    }
}
