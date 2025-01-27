<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{

    //
    public function viewpurpose()
    {
        $purposes = Purpose::all();
        return view('admin.purpose.index', compact('purposes'));
    }

    public function viewcreatepurpose()
    {
        return view('admin.purpose.create');
    }

    public function createpurpose(Request $request)
    {
        $fields = $request->validate([
            'purpose_name' => 'required',
            'purpose_description' => 'required',
        ]);

        Purpose::create($fields);
        return redirect('/viewpurpose')->with('success', 'Purpose Type Created Successfuly');
    }

    public function destroypurpose($id)
    {
        $purpose = Purpose::findOrFail($id);

        $purpose->delete();

        return redirect('/viewpurpose')->with('success', 'Purpose Deleted Successfully');
    }

    public function editpurpose($id)
    {
        $purpose = Purpose::findOrFail($id);

        return view('admin.purpose.edit', compact('purpose'));
    }

    public function updatepurpose(Request $request, $id)
    {
        $purpose = Purpose::find($id);

        $fields = $request->validate([
            'purpose_name' => 'required|string|max:255', // Added string and max length validation
            'purpose_description' => 'required|string|max:500', // Added string and max length validation
        ]);

        $purpose->save();
        $purpose = Purpose::findOrFail($id);
        $purpose->update($fields);

        return redirect('/viewpurpose')->with('success', 'Purpose updated successfully');
    }
}