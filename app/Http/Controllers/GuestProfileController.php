<?php

namespace App\Http\Controllers;

use App\Models\Please;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestProfileController extends Controller
{
    //
    public function index()
    {
        // Fetch the logged-in user
        $guestprofileuser = Auth::user();
        $pleaseheadtype = Please::all();


        // Pass the user and departments to the view
        $departments = Department::all();
        return view('guest.profile.index', compact('guestprofileuser', 'departments', 'pleaseheadtype'));
    }

    public function guestupdateprofile(Request $request, $id)
    {
        // Find the guest user and ensure they have the correct designation
        // $guestprofileuser = User::where('id', $id)
        //     ->whereIn('designation', ['Faculty', 'Head of Office',])
        //     ->firstOrFail();

        $guestprofileuser = User::where('id', $id)->firstOrFail();

        // Validate the incoming request data
        $fields = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'department' => 'nullable|string|max:255',
            'head_type' => 'nullable|string|max:255',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Avatar validation
        ]);

        // Update the user fields
        $guestprofileuser->name = $fields['fullName'];
        $guestprofileuser->email = $fields['email'];
        $guestprofileuser->phone_number = $fields['phone'];
        $guestprofileuser->department = $fields['department'] ?? $guestprofileuser->department;
        $guestprofileuser->head_type = $fields['head_type'] ?? $guestprofileuser->head_type; // Assign head_type
        // Check if the password is set, and update if provided
        if (!empty($fields['password'])) {
            $guestprofileuser->password = bcrypt($fields['password']);
        }

        // Handle avatar upload if a new avatar is provided
        if ($request->hasFile('avatar')) {
            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $guestprofileuser->avatar = $avatarPath; // Insert the new avatar path
        }

        // Save the updated user
        $guestprofileuser->save();

        return redirect('/guestprofile')->with('success', 'Profile updated successfully');
    }
}
