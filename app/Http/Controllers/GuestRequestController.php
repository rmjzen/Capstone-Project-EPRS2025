<?php

namespace App\Http\Controllers;

use App\Models\Head;
use App\Models\Slip;
use App\Models\User;
use App\Models\Purpose;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Notifications\PassSlipRequestNotification;

class GuestRequestController extends Controller
{


    public function guestviewrequest()
    {
        $purpose = Purpose::all();
        $departments = Department::all();
        $currentUser = Auth::user();
        $heads = User::where('designation', 'Head of Office')
            ->where('id', '!=', $currentUser->id) // Exclude current user if they are Head of Office
            ->get();
        // $heads = User::where('designation', 'Head of Office')->get();

        $notifications = Auth::user()->notifications()->latest()->get();

        return view('guest.requestpass.index', compact('purpose', 'departments', 'heads', 'notifications',   'currentUser'));
    }

    // public function guestrequeststore(Request $request)
    // {
    //     $fields = $request->validate([

    //         'time_departure' => 'required',
    //         'time_arrival' => 'required',
    //         'date_departure' => 'required',
    //         'date_arrival' => 'required',
    //         'purpose' => 'required',
    //         'status' => 'required',
    //         'reason' => 'required',
    //         'department' => 'required',
    //         'head_office' => 'required',
    //         'approved_by' => $request->input('head_office'), // Ensure this is set
    //         'user_id' => Auth::id(),
    //         // 'status' => 'in:approved,disapproved,canceled', // optional, can use enum validation
    //     ]);

    //     // Add the current user's ID to $fields
    //     $fields['user_id'] = Auth::id();
    //     // Create the slip
    //     $slip = Slip::create($fields);

    //     // Generate the control number (e.g., 0001, 0002, etc.)
    //     $slip->control_number = str_pad($slip->id, 8, '0', STR_PAD_LEFT);

    //     // Generate the barcode using the control number
    //     $generator = new BarcodeGeneratorPNG();
    //     $barcodeData = $generator->getBarcode($slip->control_number, $generator::TYPE_CODE_128);

    //     // Define the barcode image file name and path
    //     $barcodeFileName = 'barcode_' . $slip->control_number . '.png';
    //     $barcodePath = public_path('barcodes/' . $barcodeFileName);

    //     // Save the barcode image to the public directory
    //     Storage::disk('public')->put('barcodes/' . $barcodeFileName, $barcodeData);
    //     $slip->status = 'pending';
    //     $slip->user_id = Auth::id();

    //     // Save the barcode path or image name to the database
    //     $slip->barcode = $barcodeFileName; // Assuming you have a `barcode` column in the `slips` table

    //     // Notify the admin
    //     $admin = User::where('designation', 'Head of Office')->first();
    //     if ($admin) {
    //         $userName = Auth::user()->name; // Get the logged-in user's name
    //         // Pass $userName to the notification
    //         $admin->notify(new PassSlipRequestNotification("{$userName} has requested a pass slip."));
    //     }

    //     // Notify the selected Head of Office
    //     $headOfOffice = User::find($fields['head_office']); // Get the selected Head of Office by ID
    //     if ($headOfOffice) {
    //         $headOfOffice->notify(new PassSlipRequestNotification("{$userName} has requested a pass slip."));
    //     }



    //     $slip->save();

    //     return redirect('/guestdashboard')->with('success', 'Pass Slip Created Successfully');
    // }

    public function guesteditsliprequest($id)
    {
        // Get the specific request pass using the provided ID
        $request = Slip::findOrFail($id);

        // Get necessary data for the form
        $purpose = Purpose::all();
        $departments = Department::all();
        $heads = User::where('designation', 'Head of Office')->get();

        // Pass the data to the view for editing
        return view('guest.pass.edit', compact('request', 'purpose', 'departments', 'heads'));
    }


    public function guestupdatesliprequest(Request $request, $id)
    {
        // Find the Slip model using the provided ID
        $requestPass = Slip::findOrFail($id);

        // Validate the incoming request data
        $fields = $request->validate([
            'time_departure' => 'required|date_format:H:i',
            'time_arrival' => 'required|date_format:H:i',
            'date_departure' => 'required|date',
            'date_arrival' => 'required|date',
            'purpose' => 'required|string',
            'reason' => 'required|string|max:255',
            'department' => 'required|string',
            'head_office' => 'required|string',
            'status' => 'nullable|string',
        ]);

        // Update the request pass with validated fields
        // Check if there are any changes
        $originalData = $requestPass->only(array_keys($fields));
        $isChanged = false;

        foreach ($fields as $key => $value) {
            if ($originalData[$key] !== $value) {
                $isChanged = true;
                break;
            }
        }

        if ($isChanged) {
            // Fill the model with validated data and save
            $requestPass->fill($fields);
            $requestPass->save();

            return redirect('/guestpass')->with('success', 'Request Pass updated successfully.');
        } else {
            // Redirect with a message indicating no changes were made
            return redirect('/guestpass')->with('success', 'Request Pass updated successfully.');
        }
    }
}
