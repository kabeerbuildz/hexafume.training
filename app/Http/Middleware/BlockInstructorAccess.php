<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlockInstructorAccess
{
    /**
     * Handle an incoming request.
     * Block instructors from accessing admin or student pages
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated with web guard and is an instructor
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->role === 'instructor') {
            // Block access to admin pages
            if ($request->is('admin/*') || $request->routeIs('admin.*')) {
                return redirect()->route('instructor.dashboard')->with([
                    'messege' => __('You do not have permission to access admin pages.'),
                    'alert-type' => 'error'
                ]);
            }
            
            // Block access to student pages
            if ($request->is('student/*') || $request->routeIs('student.*')) {
                return redirect()->route('instructor.dashboard')->with([
                    'messege' => __('You do not have permission to access student pages.'),
                    'alert-type' => 'error'
                ]);
            }
        }

        return $next($request);
    }
}

