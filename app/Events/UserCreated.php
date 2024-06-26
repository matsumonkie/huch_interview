<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        Mail::send('emails.user_created', ['user' => $this->user], function ($message) {
            $message->to($this->user->email, $this->user->username)
                    ->subject('Welcome to Our Application');
        });
    }
}
