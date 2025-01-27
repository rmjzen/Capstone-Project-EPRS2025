<?php

// app/Http/Controllers/BarcodeController.php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slip;
use App\Models\Barcode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{

    public function destroy($id)
    {
        $barcode = Barcode::find($id);

        if (!$barcode) {
            return redirect()->route('barcode.view')->with('error', 'Barcode not found.');
        }

        try {
            $barcode->delete();
            return redirect()->route('barcode.view')->with('success', 'Barcode deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('barcode.view')->with('error', 'Error deleting barcode: ' . $e->getMessage());
        }
    }

    public function index()
    {
        // Fetch all scanned barcodes from the database
        $scannedBarcodes = Barcode::all(); // Adjust this to your actual fetching logic
        return view('barcode_scan', compact('scannedBarcodes'));
    }

    public function scandeparture(Request $request)
    {
        $userId = Auth::id();


        $barcodeOwner = Slip::where('user_id', $userId)->get();
        // Get the scanned barcode
        $code = $request->input('code');

        // Validate that the barcode is numeric
        if (!is_numeric($code)) {
            return redirect()->route('barcode.scan')->with('error', 'Invalid barcode format! Only numeric barcodes are allowed.');
        }

        // Find the corresponding slip based on the control number
        $slip = Slip::where('control_number', $code)->first();

        if (!$slip) {
            return redirect()->route('barcode.scan')->with('error', 'No slip found !');
        }

        // Check if a barcode entry with this code already exists
        $barcode = Barcode::where('code', $code)->first();

        if ($barcode) {
            // If actual_time_departure has already been set, prevent creating a duplicate entry
            return redirect()->route('barcode.scan')->with('success', 'Departure time  has already been recorded.');
        }

        // Create a new record with actual_time_departure set
        Barcode::create([
            'code' => $code,
            'slip_id' => $slip->id,
            'actual_time_departure' => now()->format('H:i:s'), // Set actual departure time
        ]);

        return redirect()->route('barcode.scan')->with('success', 'Departure time  recorded successfully.');
    }
    public function scanarrival(Request $request)
    {
        // Get the scanned barcode
        $code = $request->input('code');

        // Validate that the barcode is numeric
        if (!is_numeric($code)) {
            return redirect()->route('barcode.scan')->with('error', 'Invalid barcode format! Only numeric barcodes are allowed.');
        }

        // Find the corresponding slip based on the control number
        $slip = Slip::where('control_number', $code)->first();

        if (!$slip) {
            return redirect()->route('barcode.scan')->with('error', 'No slip found for this barcode!');
        }

        // Check if a barcode entry with this code already exists
        $barcode = Barcode::where('code', $code)->first();

        if ($barcode) {
            // Check if actual_time_arrival is already set
            if ($barcode->actual_time_arrival) {
                return redirect()->route('barcode.scan')->with('error', 'Arrival time for this barcode has already been recorded.');
            }

            // Update the actual_time_arrival with the current time
            $barcode->update([
                'actual_time_arrival' => now()->format('H:i:s'), // Set actual arrival time
            ]);

            return redirect()->route('barcode.scan')->with('success', 'Arrival time for barcode   recorded successfully.');
        } else {
            // If no record exists, return an error message
            return redirect()->route('barcode.scan')->with('error', 'No departure record found for this barcode!');
        }
    }
}
