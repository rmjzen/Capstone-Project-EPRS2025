<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Notification;
use App\Models\User;

class NotifyAdminOfNewUser
{
    public function handle(UserRegistered $event)
    {
        // Get all admins (or a specific admin)
        $admins = User::where('role', 'admin')->get(); // Ensure your User model has roles

        foreach ($admins as $admin) {
            // Create a notification for each admin
            Notification::create([
                'title' => 'New User Registered',
                'message' => 'A new user has registered: ' . $event->user->name,
                'type' => 'info',
                'user_id' => $admin->id,
                'is_read' => false,
            ]);
        }
    }
}