<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BecomeInstructorStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\InstructorRequest\app\Models\InstructorRequest;
use Modules\InstructorRequest\app\Models\InstructorRequestSetting;
use Modules\PaymentWithdraw\app\Models\WithdrawMethod;

class BecomeInstructorController extends Controller
{

    function index(): View|RedirectResponse
    {
        // Instructors can only be added by admin, not self-registration
        if ($this->checkIfApproveInstructor()) {
            return to_route('instructor.dashboard');
        }

        // Redirect to student dashboard with message
        return redirect()->route('student.dashboard')->with([
            'messege' => __('Instructors can only be added by admin. Please contact administrator to become an instructor.'),
            'alert-type' => 'error'
        ]);
    }

    function store(BecomeInstructorStoreRequest $request): RedirectResponse
    {
        // Instructors can only be added by admin, not self-registration
        return redirect()->route('student.dashboard')->with([
            'messege' => __('Instructors can only be added by admin. Please contact administrator to become an instructor.'),
            'alert-type' => 'error'
        ]);
    }

    function checkIfApproveInstructor(): bool
    {
        return instructorStatus() == UserStatus::APPROVED->value;
    }
}
