<?php

namespace App\Listeners;

use App\Events\UserPasswordReset;
use App\Mail\UserPasswordResetMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserPasswordResetNotification
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
     * @param  \App\Events\UserPasswordReset  $event
     * @return void
     */
    public function handle(UserPasswordReset $event)
    {
        // $url = url(route('users.password.reset', [
        //     'token' => $this->token,
        //     'email' => $event->user->getEmailForPasswordReset(),
        // ], false));;
        // Mail::to($event->user->getEmailForPasswordReset())->send(new UserPasswordResetMail($event->user,$url));
    }
}
