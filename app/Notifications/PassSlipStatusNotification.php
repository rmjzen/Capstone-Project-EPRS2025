<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class PassSlipStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $status;
    public $message;

    public function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    // Define how the notification will be delivered
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    // Prepare the data to be stored in the database
    public function toArray($notifiable)
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'icon' => $this->status === 'approved' ? 'bi-check-circle' : 'bi-x-circle',
            'icon_class' => $this->status === 'approved' ? 'text-success' : 'text-danger',
        ];
    }

    // Broadcast the notification
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'status' => $this->status,
            'message' => $this->message,
        ]);
    }
}
