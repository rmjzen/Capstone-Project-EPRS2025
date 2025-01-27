<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use App\Models\User;
use App\Models\Purpose;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PassSlipStatusNotification;




class AdminPassSlipSlipController extends Controller
{
    //
    public function viewpass(Request $request)
    {

        $slip = Slip::all();
        $totalPending = Slip::where('status', 'pending')->count();
        $passSlips = Slip::all();


        return view('admin.pass.index', compact('slip', 'totalPending', 'passSlips'));
    }

    public function passedit($id)
    {
        $slip = Slip::findOrFail($id); // Retrieve the slip by ID
        $totalPending = Slip::where('status', 'pending')->count();
        $purpose = Purpose::all();
        $departments = Department::all();
        $heads = User::all();

        return view('admin.pass.edit', compact('slip', 'totalPending', 'purpose', 'departments', 'heads'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $fields = $request->validate([
            'time_departure' => 'required',
            'time_arrival' => 'required',
            'date_departure' => 'required',
            'date_arrival' => 'required',
            'purpose' => 'required',
            'reason' => 'required',
            'department' => 'required',
            'head_office' => 'required',
        ]);

        // Find the pass slip by ID
        $slip = Slip::findOrFail($id);

        // Update the pass slip with the new data
        $slip->update($fields);

        return redirect('/viewpass')->with('success', 'Pass Slip Updated Successfully');
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
        return back()->with('success', 'Pass Slip Deleted Successfully');
    }



    // Approve pass slip
    public function approve($id)
    {
        $passSlip = Slip::findOrFail($id); // Find the pass slip by ID
        $passSlip->status = 'approved';  // Update the status to 'approved'
        $passSlip->save(); // Save the changes



        return redirect()->back()->with('success', 'Pass slip has been approved.');
    }

    // Disapprove pass slip
    public function disapprove(Request $request, $id)
    {
        $passSlip = Slip::findOrFail($id); // Find the pass slip by ID
        $passSlip->status = 'disapproved';  // Update the status to 'disapproved'
        $passSlip->save(); // Save the changes

        return redirect()->back()->with('success', 'Pass slip has been disapproved.');
    }
}