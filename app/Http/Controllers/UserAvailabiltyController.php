<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAvailabiltyController extends Controller
{
    //
    public function updateAvailability(Request $request, User $user)
    {
        // Ensure only the authenticated user can update their availability
        if (auth()->id() !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Toggle the availability status
        $user->is_available = !$user->is_available;
        $user->save();

        return response()->json([
            'success' => true,
            'is_available' => $user->is_available,
        ]);
    }
}
