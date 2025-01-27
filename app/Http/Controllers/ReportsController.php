<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use App\Models\User;
use App\Models\Purpose;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    public function index()
    {

        // Fetch data for pie chart
        $departments = Department::count();
        $designations = Designation::count();
        $purposes = Purpose::count();
        $slips = Slip::count();
        $faculty = User::where('designation', 'Faculty')->count();
        $heads = User::where('designation', 'Head of Office')->count();
        $totalPending = Slip::where('status', 'pending')->count();
        $totalApproved = Slip::where('status', 'approved')->count();
        $rejectedPassSlip = Slip::where('status', 'disapproved')->count();
        $totalUsers = User::count();
        $totalAdmin = User::where('designation', 'Admin')->count();
        // Query to get the count of slips by month
        $data = Slip::selectRaw("DATE_FORMAT(created_at, '%m') as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->pluck('count', 'month');

        // Define all months
        $monthNames = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ];

        // Create labels and fill missing months with 0
        $labels = collect($monthNames);
        $data = $labels->map(function ($month, $key) use ($data) {
            return $data->get($key, 0); // Use 0 if the month is not in the data
        });

        // Pass labels and data to the view
        return view('admin.reports.index', [
            'labels' => $labels->values(), // month names
            'data' => $data->values(),
            'departments' => $departments,
            'designations' => $designations,
            'purposes' => $purposes,
            'slips' => $slips,
            'faculty' => $faculty,
            'heads' => $heads,
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'rejectedPassSlip' => $rejectedPassSlip,
            'totalUsers' => $totalUsers,
            'totalAdmin' => $totalAdmin,
        ]);
    }
}