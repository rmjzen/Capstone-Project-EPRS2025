<?php

namespace App\Http\Controllers;

use AgeekDev\Barcode\Facades\Barcode;
use AgeekDev\Barcode\Enums\Type;
use App\Models\Slip;
use App\Models\User;
use App\Models\Purpose;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Notifications\PassSlipRequestNotification;

class AdminRequestPassSlipController extends Controller
{
    //
    public function requestpass()
    {
        $departments = Department::all();
        $purpose = Purpose::all();
        $heads = User::where('designation', 'Head of Office')->get();
        return view('admin.requestpass.index', compact('departments', 'purpose', 'heads'));
    }


    public function createrequestpass(Request $request)
    {
        $fields = $request->validate([

            'time_departure' => 'required',
            'time_arrival' => 'required',
            'date_departure' => 'required',
            'date_arrival' => 'required',
            'purpose' => 'required',
            'reason' => 'required',
            'department' => 'required',
            'head_office' => 'required',
            // 'status' => 'in:approved,disapproved,canceled', // optional, can use enum validation
        ]);

        // Add the current user's ID to $fields
        $fields['user_id'] = Auth::id();
        // Create the slip
        $slip = Slip::create($fields);

        // Generate the control number (e.g., 0001, 0002, etc.)
        // Set the control number with leading zeroes based on the slip ID
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



        // Save the barcode path or image name to the database
        $slip->barcode = $barcodeFileName; // Assuming you have a `barcode` column in the `slips` table
        $slip->status = 'pending';
        $slip->user_id = Auth::id();;



        // Notify the selected Head of Office
        $headOfOffice = User::find($fields['head_office']);
        if ($headOfOffice) {
            $userName = Auth::user()->name;
            $headOfOffice->notify(new PassSlipRequestNotification("{$userName} has requested a pass slip."));
        }

        // Save the slip with the barcode information
        $slip->save();

        return redirect('/viewpass')->with('success', 'Pass Slip Created Successfully');
    }

    private function generateBarcode($controlNumber)
    {
        // Implement your barcode generation logic here, e.g., using a library
        // For simplicity, return the control number as the barcode
        return $controlNumber;
    }

    public function updateStatus(Request $request, Slip $slip)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,disapproved,canceled',
        ]);

        $slip->updateStatus($validated['status']);
        return redirect()->route('slips.index')->with('success', 'Status updated successfully.');
    }

    public function editrequestpass($id)
    {
        $requestPass = Slip::findOrFail($id); // Replace with your model
        $purpose = Purpose::all();
        $departments = Department::all();
        $heads = User::where('designation', 'Head of Office')->get();
        $slip = Slip::all();

        return view('admin.requestpass.edit', compact('requestPass', 'purpose', 'departments', 'heads', 'slip'));
    }

    public function updateRequestPass(Request $request, $id)
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
            'status' => 'required|string', // Ensure only valid statuses
            'reason' => 'required|string',
            'department' => 'required|string',
            'head_office' => 'required|string',
        ]);

        // Check if there are changes to the model
        $originalData = $requestPass->only(array_keys($fields));
        $isChanged = false;

        foreach ($fields as $key => $value) {
            if ($originalData[$key] !== $value) {
                $isChanged = true;
                break;
            }
        }

        if ($isChanged) {
            // Update the model with validated data
            $requestPass->update($fields);
            return redirect('/viewpass')->with('success', 'Request Pass updated successfully.');
        }

        // Redirect with a message indicating no changes were made
        return redirect('/viewpass')->with('info', 'No changes were made to the Request Pass.');
    }
}
