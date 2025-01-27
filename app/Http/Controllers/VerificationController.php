<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function showVerifyForm()
    {
        $user = Auth::user();

        // Check if the user is verified
        if ($user->is_verified) {
            // Redirect to the faculty dashboard if the user is verified
            return redirect()->route('guestdashboard');
        }

        // Otherwise, show the verification form
        return view('auth.verify');
    }

    public function verifyCode(Request $request)
    {
        // Validate the input
        $request->validate([
            'verification_code' => 'required|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Ensure that user exists and the verification code matches
        if ($user && $user->verification_code === $request->verification_code) {
            $user->is_verified = true; // Set user as verified
            $user->save();  // Save the updated user instance

            return redirect('/guestdashboard')->with('success', 'Your account is verified!');
        }

        // If the verification fails, return back with error
        return back()->with('error', 'Invalid verification code.');
    }
}
