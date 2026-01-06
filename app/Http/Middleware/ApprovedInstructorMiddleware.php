<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedInstructorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!instructorStatus() || instructorStatus() && instructorStatus() != UserStatus::APPROVED->value) {
            // Instructors can only be added by admin, redirect to student dashboard
            return redirect()->route('student.dashboard')->with([
                'messege' => __('You are not an approved instructor. Please contact admin to become an instructor.'),
                'alert-type' => 'error'
            ]);
        }

        return $next($request);
    }
}
