<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mail.new-user-created');
        return $this->subject('Welcome to Storehouse')
                    ->view('mail.new-user-created')
                    ->with([
                        'username' => $this->user->username,
                        'first_name' => $this->user->first_name,
                        'url' => $this->verificationUrl()
                    ]);

    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'set.password', now()->addMinutes(30), ['user' => $this->user->id]
        );
    }
}
