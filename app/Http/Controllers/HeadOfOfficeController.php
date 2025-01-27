<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadOfOfficeController extends Controller
{
    //
    public function viewheaddashboard()
    {
        return view('headofoffice.dashboard');
    }
}
