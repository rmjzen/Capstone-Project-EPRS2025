<?php

namespace App\Http\Controllers;

use AgeekDev\Barcode\Facades\Barcode;
use AgeekDev\Barcode\Enums\Type;
use App\Mail\ApprovePassSlipMail;
use App\Mail\RejectPassSlipMail;
use App\Mail\RequestPassSlipMail;
use App\Models\Slip;
use App\Models\User;
use Twilio\Rest\Client;
use Milon\Barcode\DNS1D;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Notifications\Notification;
use App\Notifications\EmailNotificationPassSlip;
use App\Notifications\PassSlipRequestNotification;
use App\Notifications\PassSlipApprovalNotification;
use App\Notifications\PassSlipRejectionNotification;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    //

    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user(); // Get the authenticated user

            // Check the user's designation
            if ($user->designation === 'Admin') {
                return redirect('/admin');
            } elseif ($user->designation === 'Faculty') {
                return redirect('/guestdashboard');
            } else {
                return redirect('/guestdashboard');
            }
        } else {
            return redirect('/login'); // Redirect to the login page if not authenticated
        }
    }



    public function viewguestdashboard()
    {
        $userId = Auth::id();
        $userDesignation = Auth::user()->designation; // Assuming you have a designation column in your users table

        // Retrieve slips created by the logged-in user
        $createdSlips = Slip::where('user_id', $userId)->get();

        // Retrieve slips where the logged-in user is chosen as Head of Office
        $headOfficeSlips = Slip::where('approved_by', $userId)->get();

        // Combine both sets of slips
        $allSlips = $createdSlips->merge($headOfficeSlips);

        // Calculate total and status counts for all slips the user is associated with
        $totalPassSlips = $allSlips->count();
        $pendingPassSlips = $allSlips->where('status', 'pending')->count();
        $approvedPassSlip = $allSlips->where('status', 'approved')->count();
        $rejectedPassSlip = $allSlips->where('status', 'disapproved')->count();



        // Count how many users have chosen the logged-in user as approver
        $chosenAsApproverCount = Slip::where('approved_by', $userId)->count();


        $notifications = Auth::user()->notifications()->latest()->get();

        return view('guest.dashboard', compact('totalPassSlips', 'pendingPassSlips', 'approvedPassSlip', 'rejectedPassSlip', 'chosenAsApproverCount', 'userDesignation', 'notifications'));
    }





    public function guestpassview()
    {
        $userId = Auth::id();

        // Fetch the designation of the currently logged-in user
        $userDesignation = Auth::user()->designation;

        // Pass slips created by the logged-in user
        $slip = Slip::where('user_id', $userId)->get();

        // Total pass slip count of the current logged user
        $totalPassSlips = $slip->count();

        // Initialize an empty collection for head office slips
        $headOfficeSlips = collect();

        $heads = User::all();

        // If the user is 'Head of Office,' retrieve slips where they are chosen as approver
        if ($userDesignation === 'Head of Office') {
            $headOfficeSlips = Slip::where('head_office', $userId)->get();
        }

        return view('guest.pass.index', compact('slip', 'totalPassSlips', 'headOfficeSlips', 'heads'));
    }



    public function guestrequeststore(Request $request)
    {
        // Validate the incoming request
        $fields = $request->validate([
            'time_departure' => 'required',
            'time_arrival' => 'required',
            'date_departure' => 'required|date',
            'date_arrival' => 'required|date',
            'purpose' => 'required',
            'reason' => 'required',
            'department' => 'required',
            'head_office' => 'required', // This is the selected Head of Office
        ]);


        $fields['user_id'] = Auth::id();
        // Set the 'approved_by' field to the selected Head of Office
        $fields['approved_by'] = $fields['head_office'];

        // Find the selected Head of Office
        $headOfOffice = User::find($fields['head_office']);
        if (!$headOfOffice || $headOfOffice->designation !== 'Head of Office') {
            return response()->json(['error' => 'Head of Office not found'], 404);
        }

        $userName = Auth::user()->name; // Get the logged-in user's name

        // Notify the admin
        $admin = User::where('designation', 'Admin')->first();
        if ($admin) {
            // Mail::to($admin->email)->queue(new RequestPassSlipMail($admin->name)); // Notify admin via email
            $admin->notify(new PassSlipRequestNotification("{$userName} has requested a pass slip")); // Notify admin via app notification
        }


        // Notify the selected Head of Office via application notification and email
        if ($headOfOffice) {
            $headOfOffice->notify(new PassSlipRequestNotification("{$userName} has requested a pass slip.")); // Notify via app
            // Mail::to($headOfOffice->email)->queue(new RequestPassSlipMail($headOfOffice->name)); // Notify via email
        }

        // Handle avatar upload if a new avatar is provided
        if ($request->hasFile('avatar')) {
            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            // Update the user's avatar in the users table
            $user = Auth::user();
            $user->avatar = $avatarPath;
            $user->save();
        }

        // Create the pass slip
        $slip = Slip::create($fields);
        // Generate the control number (e.g., 00000001, 00000002, etc.)
        $slip->control_number = str_pad($slip->id, 8, '0', STR_PAD_LEFT);

        // Generate the barcode using the control number
        $barcodeData = Barcode::imageType("svg")
            ->foregroundColor("#000000")
            ->height(30)
            ->widthFactor(2)
            ->type(Type::TYPE_CODE_128)
            ->generate($slip->control_number);


        $barcodeFileName = "barcode_{$slip->control_number}.svg";
        Storage::disk('public')->put("barcodes/{$barcodeFileName}", $barcodeData);

        // Save the barcode filename to the database (not the full path)
        $slip->barcode = $barcodeFileName; // Store only the filename
        $slip->status = 'pending';  // Set initial status to pending

        $user = Auth::user();
        // Save the slip record
        $slip->save();


        // Send notification if needed
        // send sms
        // $message = "{$user->name} has requested a pass slip. Please visit the website to approve: https://oyster-app-x7aid.ondigitalocean.app/";
        // $headOfOfficePhoneNumber = "+639704505536";
        // $this->sendSmsNotification($headOfOfficePhoneNumber, $message);


        return redirect('/guestpass')->with('success', 'Pass Slip Created Successfully');
    }



    private function sendSmsNotification($to, $message)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $twilio->messages->create(
            $to,
            [
                "messagingServiceSid" => env('TWILIO_MESSAGING_SERVICE_SID'),
                "body" => $message
            ]
        );
    }




    public function destroy($id)
    {
        // Find the slip by ID
        $slip = Slip::findOrFail($id);

        // Delete the barcode image from the storage (if needed)
        if ($slip->barcode) {
            Storage::disk('public')->delete('barcodes/' . $slip->barcode);
        }

        // Delete the slip
        $slip->delete();

        // Redirect back with a success message
        return redirect('/guestpass')->with('success', 'Pass Slip Deleted Successfully');
    }

    public function guestlogout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'logged out successfully');
    }
    public function verifyout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'logged out successfully');
    }

    public function approveByHeadOffice($id)
    {
        $slip = Slip::findOrFail($id);

        // Ensure the current user is 'Head of Office' and chosen as approver
        if (Auth::user()->designation === 'Head of Office' && $slip->head_office == Auth::id()) {
            // Update the slip status to approved
            $slip->status = 'approved';
            $slip->save();

            // Notify the user about the approval
            $user = $slip->user;
            // Assuming you have a relationship in Slip model
            if ($user) {
                $user->notify(new PassSlipApprovalNotification("Your pass slip has been approved."));
                // Mail::to($user->email)->queue(new ApprovePassSlipMail($user->name));
            }




            return redirect()->back()->with('success', 'Pass slip approved successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    public function disapproveByHeadOffice(Request $request, $id)
    {
        $slip = Slip::findOrFail($id);

        // Ensure the current user is 'Head of Office' and chosen as approver
        if (Auth::user()->designation === 'Head of Office' && $slip->head_office == Auth::id()) {
            // Update the slip status to disapproved
            $slip->status = 'disapproved';
            $slip->save();

            // Notify the user about the rejection
            $user = $slip->user; // Assuming you have a relationship in Slip model
            if ($user) {
                $user->notify(new PassSlipRejectionNotification("Your pass slip has been rejected."));
                // Mail::to($user->email)->queue(new RejectPassSlipMail($user->name));
            }

            return redirect()->back()->with('success', 'Pass slip disapproved successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}