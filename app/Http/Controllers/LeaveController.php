<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Notifications\PassSlipStatusNotification;
use App\Notifications\PassSlipApprovalNotification;
use App\Notifications\PassSlipRejectionNotification;

class LeaveController extends Controller
{
    // Approve leave request
    public function approve($id)
    {
        $passSlip = Slip::findOrFail($id);
        $passSlip->status = 'approved';
        $passSlip->save();

        // Notify the user about the approval
        $user = $passSlip->user; // Assuming you have a relationship in Slip model
        if ($user) {
            $user->notify(new PassSlipApprovalNotification("Your pass slip has been approved."));
        }

        return redirect()->back()->with('success', 'Pass slip has been approved.');
    }

    // Reject a pass slip
    public function reject($id)
    {
        $passSlip = Slip::findOrFail($id);
        $passSlip->status = 'disapproved'; // or 'disapproved'
        $passSlip->save();

        // Notify the user about the rejection
        $user = $passSlip->user; // Assuming you have a relationship in Slip model
        if ($user) {
            $user->notify(new PassSlipRejectionNotification("Your pass slip has been rejected."));
        }

        return redirect()->back()->with('success', 'Pass slip has been rejected.');
    }
}