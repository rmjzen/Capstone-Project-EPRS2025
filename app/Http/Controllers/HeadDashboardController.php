<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeadDashboardController extends Controller
{
    //

    public function index()
    {
        return view('head.dashboard');
    }

    public function headpassview()
    {
        $userId = Auth::id();

        // Fetch the designation of the currently logged-in user
        $userDesignation = Auth::user()->designation;

        // Pass slips created by the logged-in user
        $slip = Slip::where('user_id', $userId)->get();

        // Total pass slip count of the current logged user
        $totalPassSlips = $slip->count();

        // Initialize an empty collection for head office slips
        $headOfficeSlips = collect();

        // If the user is 'Head of Office,' retrieve slips where they are chosen as approver
        if ($userDesignation === 'Head of Office') {
            $headOfficeSlips = Slip::where('head_office', $userId)->get();
        }

        return view('guest.pass.index', compact('slip', 'totalPassSlips', 'headOfficeSlips'));
    }
}
