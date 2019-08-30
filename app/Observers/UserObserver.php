<?php

namespace App\Observers;

use Mail;
use App\Models\User;
use App\Mail\UserCreatedMail;
use App\Traits\RandomTextGenerator;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\user  $user
     * @return void
     */
    public function created(user $user)
    {
        Mail::to($user->email)->send(new UserCreatedMail($user));
    }

    public function creating(User $user)
    {
        //Mail::to($user->email)->send(new UserCreatedMail($user));
    }
}
