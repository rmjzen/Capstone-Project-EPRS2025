<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PassSlipRequestNotification;
use App\Notifications\PassSlipApprovalNotification;
use App\Notifications\PassSlipRejectionNotification;
use App\Notifications\UserRegistrationNotification;

class NotificationController extends Controller
{
    //
    public function markAllAsRead()
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the appropriate designation
        if ($user && in_array($user->designation, ['Admin', 'Head of Office', 'Faculty'])) {
            // List of notification types to mark as read
            $notificationTypes = [
                PassSlipRequestNotification::class,
                PassSlipApprovalNotification::class,
                PassSlipRejectionNotification::class,
                UserRegistrationNotification::class,
            ];

            // Filter and mark all specified pass slip notifications as read
            $user->unreadNotifications
                ->whereIn('type', $notificationTypes)
                ->each(function ($notification) {
                    $notification->markAsRead();
                });

            return redirect()->back()->with('success', 'All notifications marked as read.');
        }

        return redirect()->back()->with('error', 'You do not have permission to mark notifications as read.');
    }

    public function markAllAsReadguest()
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the appropriate designation
        if ($user && in_array($user->designation, ['Admin', 'Head of Office', 'Faculty'])) {
            // List of notification types to mark as read
            $notificationTypes = [
                PassSlipRequestNotification::class,
                PassSlipApprovalNotification::class,
                PassSlipRejectionNotification::class,
            ];

            // Filter and mark all specified pass slip notifications as read
            $user->unreadNotifications
                ->whereIn('type', $notificationTypes)
                ->each(function ($notification) {
                    $notification->markAsRead();
                });

            return redirect()->back()->with('success', 'All notifications marked as read.');
        }

        return redirect()->back()->with('error', 'You do not have permission to mark notifications as read.');
    }
}