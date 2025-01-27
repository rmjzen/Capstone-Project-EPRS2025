<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{

    public function guestlogout(Request $request)
    {
        Auth::logout();

        return redirect('/')->with('success', 'logged out successfully');
    }
    //
    public function viewfaculty()
    {
        $faculty = User::where('designation', 'Faculty')->get();
        return view('admin.faculty.index', compact('faculty'));
    }

    public function viewcreatefaculty()
    {
        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.faculty.create', compact('departments', 'departments', 'designations'));
    }

    public function createfaculty(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'department' => 'required',
            // 'designation' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
        ]);

        $fields['designation'] = 'Faculty';
        $fields['password'] = bcrypt($fields['password']);

        User::create($fields);

        return redirect('/viewfaculty')->with('success', 'Faculty Created Successfully');
    }

    public function destroyfaculty($id)
    {
        $faculty = User::findOrFail($id);

        $faculty->delete();
        return redirect('/viewhead')->with('success', 'User Deleted Successfully');
    }
}