<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PassSlipRejectionNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // Use appropriate channels
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
