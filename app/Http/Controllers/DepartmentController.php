<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function editdepartment($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.department.edit', compact('department'));
    }

    public function updatedepartment(Request $request, $id)
    {
        // Find the department or fail with a 404 error
        $department = Department::find($id);

        // Validate the incoming request data
        $fields = $request->validate([
            'dept_name' => 'required|string|max:255', // Added string and max length validation
            'dept_description' => 'required|string|max:500', // Added string and max length validation
        ]);

        // Update the department's details using mass assignment
        $department->save();
        // Save the updated request
        // Find the request pass and update it
        $department = Department::findOrFail($id); // Replace with your model
        $department->update($fields); // You can directly use the $fields array here


        // Redirect back to the view with a success message
        return redirect('/viewdepartment')->with('success', 'Department Edited Successfully'); // Fixed typo 'sucess' to 'success'
    }

    //
    public function viewdept()
    {
        $departments = Department::all();


        // Pass the departments to the view
        return view('admin.department.index', compact('departments'));
    }


    public function createdept(Request $request)
    {


        return view('admin.department.create');
    }

    public function postdept(Request $request)
    {
        $fields = $request->validate([
            'dept_name' => 'required',
            'dept_description' => 'required',
        ]);
        Department::create($fields);
        return redirect('/viewdepartment')->with('success', 'Department Created Successfully');
    }

    public function destroydepartment($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        return redirect('/viewdepartment')->with('success', 'Department Deleted Successfully');
    }
}