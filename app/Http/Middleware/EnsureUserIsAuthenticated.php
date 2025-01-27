<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Restrict access for Admin to the guest dashboard
            if ($user->designation === 'Admin' && $request->is('guestdashboard')) {
                return redirect('/admin'); // Redirect Admin away from the guest dashboard
            }

            // Optional: Redirect guests to login page if they try to access protected routes
            if (!$user->is_verified) {
                return redirect('/verify')->with('error', 'Please verify your account first.');
            }
        } else {
            // Redirect guest users to the login page if they're not authenticated
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}