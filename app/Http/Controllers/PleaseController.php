<?php

namespace App\Http\Controllers;

use App\Models\Please;
use Illuminate\Http\Request;

class PleaseController extends Controller
{
    //

    public function index()
    {
        $headtype = Please::all();
        return view('admin.pleaseheadtype.index', compact('headtype'));
    }


    public function viewcreateheadtype()
    {
        return view('admin.pleaseheadtype.create');
    }


    public function createheadtype(Request $request)
    {
        $fields = $request->validate([
            'please_name' => 'required|string|max:255', // Ensure 'please_name' is required and is a string
        ]);

        Please::create($fields);

        return redirect('/viewheadtype')->with('success', 'Head of Office Type Created Successfully');
    }


    public function destroyheadtype($id)
    {
        $headtype = Please::findOrFail($id);

        $headtype->delete();

        return redirect('/viewheadtype')->with('success', 'headtype Deleted Successfully');
    }
}