<?php

namespace App\Providers;

use App\Providers\Registereds;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotifications
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
     * @param  \App\Providers\Registereds  $event
     * @return void
     */
    public function handle(Registereds $event)
    {
        //
    }
}
