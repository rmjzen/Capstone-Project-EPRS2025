<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function showSmsForm()
    {
        return view('send-sms');
    }

    public function sendSms(Request $request)
    {
        // Validate required fields
        $request->validate([
            'phone_number' => 'required|string',
            'message' => 'required|string'
        ]);

        // Prepare the data to send
        $data = [
            'api_token' => env('SMS_API_TOKEN'), // API token from .env
            'phone_number' => $request->input('phone_number'),
            'message' => $request->input('message')
        ];

        // Make the POST request to the API
        $response = Http::post(env('SMS_API_BASE_URL'), $data);

        // Handle response
        if ($response->successful()) {
            return redirect()->back()->with('success', 'SMS sent successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to send SMS: ' . $response->body());
        }
    }
}
