<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function editdesignation($id)
    {
        $designations = Designation::findOrFail($id);


        return view('admin.designation.edit', compact('designations'));
    }

    public function updatedesignation(Request $request, $id)
    {
        // Find the designation or fail with a 404 error
        $designation = Designation::find($id);

        // Validate the incoming request data
        $fields = $request->validate([
            'designation_name' => 'required|string|max:255', // Added string and max length validation
            'designation_desc' => 'required|string|max:500', // Added string and max length validation
        ]);

        $designation->save();

        $designation = Designation::findOrFail($id); // Replace with your model
        $designation->update($fields); // You can directly use the $fields array here


        // Redirect back to the view with a success message
        return redirect('/viewdesignation')->with('success', 'Designation Edited Successfully'); // Fixed typo 'sucess' to 'success'
    }

    //
    public function viewdesignation()
    {
        $designations = Designation::all();
        return view('admin.designation.index', compact('designations'));
    }

    public function viewcreatedesignation()
    {
        $designations = Designation::all();
        return view('admin.designation.create', compact('designations'));
    }

    public function createdesignation(Request $request)
    {
        $designations = Designation::all();


        $fields = $request->validate([
            'designation_name' => 'required',
            'designation_desc' => 'required',
        ]);

        Designation::create($fields);

        return redirect('/viewdesignation')->with('success', 'New Designation Created Successfully');
    }


    public function destroydesignation($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();

        return redirect('/viewdesignation')->with('success', 'Designation Deleted Successfully');
    }
}