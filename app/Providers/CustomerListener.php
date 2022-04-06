<?php

namespace App\Providers;
use App\Jobs\SendEmailJob;
use App\Models\CustomerNew;
use App\Providers\CustomerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\CustomerMail;
use Illuminate\Support\Facades\Mail;


class CustomerListener
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
     * @param  \App\Providers\CustomerEvent  $event
     * @return void
     */
    
    public function handle(CustomerEvent $event)
    {    
        // dd($event->user->email);
        $user = CustomerNew::find($event->user);
        $email = $user['0']['email'];
        dispatch(new SendEmailJob($email));
    }
}
