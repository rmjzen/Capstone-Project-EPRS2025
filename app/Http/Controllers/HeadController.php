<?php

namespace App\Http\Controllers;

use App\Models\Head;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HeadController extends Controller
{
    //
    public function viewhead()
    {
        // Retrieve all users with the specified designations
        // $heads = User::whereIn('designation', ['Head of Office', 'Faculty', 'Admin', 'Employee'])->get();
        $heads = User::all();

        // Alternatively, if you need only the designations but not the users, you could use:
        // $designations = User::distinct()->pluck('designation');


        return view('admin.head.index', compact('heads'));
    }

    public function viewcreatehead()
    {

        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.head.create', compact('departments', 'designations'));
    }

    public function createhead(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
        ]);
        // Format the phone number to include "+63" if it starts with "0"
        $fields['phone_number'] = $this->formatPhoneNumber($fields['phone_number']);

        // $fields['designation'] = 'Head of Office';
        $fields['password'] = bcrypt($fields['password']);
        User::create($fields);

        return redirect(to: '/viewhead')->with('success', 'User created successfully');
    }

    private function formatPhoneNumber($phoneNumber)
    {
        // Check if the phone number starts with "0"
        if (substr($phoneNumber, 0, 1) === '0') {
            return '+63' . substr($phoneNumber, 1);
        }
        return $phoneNumber;
    }

    public function destroyhead($id)
    {

        $head = User::where('id', $id)->where('designation', 'Head of Office')->firstOrFail();
        $head->delete();
        return redirect(to: '/viewhead')->with('success', 'User deleted successfully');
    }

    public function edithead($id)
    {
        // Retrieve the user by ID; you may want to remove the designation filter if needed
        $head = User::findOrFail($id); // This retrieves the user regardless of their designation

        // Fetch departments and designations for the edit form
        $departments = Department::all();
        $designation = Designation::all();

        // Return the edit view with the user data
        return view('admin.head.edit', compact('head', 'departments', 'designation'));
    }


    public function updatehead(Request $request, $id)
    {
        // Validate the incoming request data
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  // Ensure email is unique except for the current user
            'phone_number' => 'required|string|max:15',
            'password' => 'nullable|min:8', // No password confirmation required
            'designation' => 'nullable|string|max:255', // Add string validation for designation
        ]);

        // Find the user with the given id
        $head = User::findOrFail($id); // This retrieves the user regardless of their designation

        // Only set the password if it is provided
        if ($request->filled('password')) {
            $fields['password'] = Hash::make($request->input('password'));
        } else {
            // Remove password from the fields to prevent setting it to null
            unset($fields['password']);
        }

        // Update the user with the remaining fields
        $head->update($fields);

        // Redirect back to the list of heads or another appropriate page with a success message
        return redirect()->route('admin.viewhead')->with('success', 'User Detail updated successfully!');
    }
}
