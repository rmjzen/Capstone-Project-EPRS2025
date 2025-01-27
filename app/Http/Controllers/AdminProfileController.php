<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        $admin = User::where('designation', 'Admin')->firstOrFail();
        return view('admin.profile.index', compact('admin', 'departments'));
    }


    // {
    //     // Validate the incoming request data
    //     $fields = $request->validate([
    //         'fullName' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'phone' => 'required|string|max:15',
    //         'department' => 'nullable|string|max:255',
    //         'password' => 'nullable|min:8',
    //         'avatar' => 'nullable|required', // Avatar validation
    //     ]);

    //     // Find the admin user
    //     $admin = User::where('id', $id)->where('designation', 'Admin')->firstOrFail();

    //     // Update the user fields
    //     $admin->name = $fields['fullName'];
    //     $admin->email = $fields['email'];
    //     $admin->phone_number = $fields['phone'];
    //     $admin->department = $fields['department'] ?? $admin->department;

    //     // Check if the password is set, and update if provided
    //     if (!empty($fields['password'])) {
    //         $admin->password = bcrypt($fields['password']);
    //     }

    //     // Handle avatar upload if a new avatar is provided
    //     if ($request->hasFile('avatar')) {
    //         // Delete old avatar if exists
    //         if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
    //             Storage::disk('public')->delete($admin->avatar);
    //         }

    //         // Store new avatar
    //         $avatarPath = $request->file('avatar')->store('avatars', 'public');
    //         $admin->avatar = $avatarPath; // Insert the new avatar path
    //     }

    //     // Save the updated admin user
    //     $admin->save();

    //     return redirect('/adminprofile')->with('success', 'Admin profile updated successfully');
    // }

    public function adminupdateprofile(Request $request, $id)
    {
        // Validate the incoming request data
        $fields = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'department' => 'nullable|string|max:255',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Make avatar optional and allow only images
        ]);

        // Find the admin user
        $admin = User::where('id', $id)->where('designation', 'Admin')->firstOrFail();

        // Update the user fields
        $admin->name = $fields['fullName'];
        $admin->email = $fields['email'];
        $admin->phone_number = $fields['phone'];
        $admin->department = $fields['department'] ?? $admin->department;

        // Check if the password is set, and update if provided
        if (!empty($fields['password'])) {
            $admin->password = bcrypt($fields['password']);
        }

        // Handle avatar upload if a new avatar is provided
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
                Storage::disk('public')->delete($admin->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $avatarPath; // Insert the new avatar path
        } else {
            // Keep the existing avatar if no new file is uploaded
            $admin->avatar = $admin->avatar; // This line can be omitted since it does nothing
        }

        // Save the updated admin user
        $admin->save();

        return redirect('/adminprofile')->with('success', 'Admin profile updated successfully');
    }
}