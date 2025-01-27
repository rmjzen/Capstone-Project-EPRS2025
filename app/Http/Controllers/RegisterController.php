<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use Log;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Please;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserRegisteredNotification;
use App\Notifications\UserRegistrationNotification;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    //

    public function viewregister()
    {

        $departments = Department::all();
        $designations = Designation::all();
        $pleaseheadtype = Please::all();
        return view('auth.register', compact('departments', 'designations', 'pleaseheadtype'));
    }
    public function createregister(Request $request)
    {
        $verification_code = Str::random(6); // Generate a 6-character random code

        // Validate the incoming request data
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'department' => ['nullable', 'string'],
            'designation' => ['nullable', 'string'],
            'head_type' => ['nullable', 'string'],
            'phone_number' => 'required|string|max:15', // Adjust the max length as needed
            'email' => ['required', 'email', Rule::unique('users', 'email')], // Check for unique email
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Confirmed password
        ], [
            // Custom error messages
            'email.unique' => 'The email address is already registered. Please use a different email or log in.',
        ]);

        // Set a default value if department is null
        $fields['department'] = $fields['department'] ?? 'Technology Department';

        // Manually add verification code and verified status
        $fields['verification_code'] = $verification_code;
        $fields['is_verified'] = false; // Set as not verified
        $fields['is_available'] = true;

        // Hash the password before saving
        $fields['password'] = Hash::make($fields['password']);

        // Create the new user
        $user = User::create($fields);

        //notify the admin using their email

        $adminsemail = User::where('designation', 'Admin')->get();
        foreach ($adminsemail as $admin) {
            // Queue the email instead of sending it synchronously
            Mail::to($admin->email)->queue(new RegisterMail($admin->name));
        }

        // Notify the admin

        // Notify the admin(s)
        $admins = User::where('designation', 'Admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new UserRegistrationNotification("{$user->name} created an account and is waiting for your verification."));
        }



        // Redirect to login page with success message
        // return redirect('/login')->with('success', 'Registered successfully. Please wait for the administrator to verify your account.');
        return redirect('/login')->with([
            'success' => 'Registered successfully. Please wait for the administrator to verify your account.',
            'email' => $request->email,
        ]);
    }
}
