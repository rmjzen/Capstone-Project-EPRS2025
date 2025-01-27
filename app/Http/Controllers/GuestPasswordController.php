<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GuestPasswordController extends Controller
{
    //
    public function guestchangepass(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Ensure the user has the Faculty or Head of Office designation
        if (!in_array($user->designation, ['Faculty', 'Head of Office'])) {
            return redirect()->back()->with('error', 'You do not have permission to change the password.');
        }

        // Validate the input fields
        $fields = $request->validate([
            'current_password' => 'required',
            'password' => 'nullable|min:8|confirmed', // 'confirmed' checks for password_confirmation
        ], [
            'password.confirmed' => 'The new password and confirmation do not match.',
        ]);

        // Check if the current password is correct
        if (!Hash::check($fields['current_password'], $user->password)) {
            // Throw a validation exception with a custom message for the current password
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        // Only set and hash the new password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($fields['password']);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        }

        return redirect()->back()->with('error', 'No new password provided.');
    }
}