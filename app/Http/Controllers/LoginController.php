<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function viewlogin()
    {
        if (Auth::check()) {
            return view('guest.dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        // Validate incoming request fields
        $incomingFields = $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'string']
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password'],
        ])) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Check if the authenticated user has an admin designation
            if (Auth::user()->designation === 'Admin') {
                // Redirect to the admin dashboard if the user is an admin
                return redirect('/admin')->with('success', 'Welcome to the Admin Dashboard.');
            }

            // Redirect to the guest dashboard for non-admin users
            return redirect('/guestdashboard')->with('success', 'You have successfully logged in.');
        } else {
            // Redirect back to the login page with an error message
            return redirect('/login')->with('error', 'Invalid login.');
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'logged out successfully');
    }
}