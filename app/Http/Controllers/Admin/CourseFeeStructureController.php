<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseFeeStructure;
use App\Models\FeeStructureDuration;
use App\Models\FeeStructureLocation;
use Illuminate\Http\Request;

class CourseFeeStructureController extends Controller
{
    public function index(Request $request)
    {
        $query = CourseFeeStructure::with(['course', 'location', 'duration']);

        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->duration_id) {
            $query->where('duration_id', $request->duration_id);
        }

        $feeStructures = $query->orderBy('location_id')->orderBy('duration_id')->orderBy('serial_number')->paginate(20);
        $locations = FeeStructureLocation::where('status', 1)->orderBy('name')->get();
        $durations = FeeStructureDuration::where('status', 1)->orderBy('value')->get();

        return view('admin.fee-structure.course-fee-structures.index', compact('feeStructures', 'locations', 'durations'));
    }

    public function create()
    {
        $courses = Course::where('status', 'active')->where('is_approved', 'approved')->orderBy('title')->get();
        $locations = FeeStructureLocation::where('status', 1)->orderBy('name')->get();
        $durations = FeeStructureDuration::where('status', 1)->orderBy('value')->get();

        return view('admin.fee-structure.course-fee-structures.create', compact('courses', 'locations', 'durations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'location_id' => 'required|exists:fee_structure_locations,id',
            'duration_id' => 'required|exists:fee_structure_durations,id',
            'course_fee' => 'required|numeric|min:0',
            'registration_fee' => 'nullable|numeric|min:0',
            'serial_number' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        // Check if combination already exists
        $exists = CourseFeeStructure::where('course_id', $request->course_id)
            ->where('location_id', $request->location_id)
            ->where('duration_id', $request->duration_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => __('This course-location-duration combination already exists')])->withInput();
        }

        $feeStructure = new CourseFeeStructure();
        $feeStructure->course_id = $request->course_id;
        $feeStructure->location_id = $request->location_id;
        $feeStructure->duration_id = $request->duration_id;
        $feeStructure->course_fee = $request->course_fee;
        $feeStructure->registration_fee = $request->registration_fee ?? 0;
        $feeStructure->serial_number = $request->serial_number ?? 0;
        $feeStructure->status = $request->status;
        $feeStructure->save();

        // If it's an AJAX request (from course creation flow), return JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('Course fee structure created successfully'),
                'redirect' => request()->input('redirect') // Optional redirect URL
            ]);
        }

        return redirect()->route('admin.course-fee-structures.index')
            ->with('success', __('Course fee structure created successfully'));
    }

    public function edit($id)
    {
        $feeStructure = CourseFeeStructure::findOrFail($id);
        $courses = Course::where('status', 'active')->where('is_approved', 'approved')->orderBy('title')->get();
        $locations = FeeStructureLocation::where('status', 1)->orderBy('name')->get();
        $durations = FeeStructureDuration::where('status', 1)->orderBy('value')->get();

        return view('admin.fee-structure.course-fee-structures.edit', compact('feeStructure', 'courses', 'locations', 'durations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'location_id' => 'required|exists:fee_structure_locations,id',
            'duration_id' => 'required|exists:fee_structure_durations,id',
            'course_fee' => 'required|numeric|min:0',
            'registration_fee' => 'nullable|numeric|min:0',
            'serial_number' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $feeStructure = CourseFeeStructure::findOrFail($id);

        // Check if combination already exists (excluding current record)
        $exists = CourseFeeStructure::where('course_id', $request->course_id)
            ->where('location_id', $request->location_id)
            ->where('duration_id', $request->duration_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => __('This course-location-duration combination already exists')])->withInput();
        }

        $feeStructure->course_id = $request->course_id;
        $feeStructure->location_id = $request->location_id;
        $feeStructure->duration_id = $request->duration_id;
        $feeStructure->course_fee = $request->course_fee;
        $feeStructure->registration_fee = $request->registration_fee ?? 0;
        $feeStructure->serial_number = $request->serial_number ?? 0;
        $feeStructure->status = $request->status;
        $feeStructure->save();

        return redirect()->route('admin.course-fee-structures.index')
            ->with('success', __('Course fee structure updated successfully'));
    }

    public function destroy($id)
    {
        $feeStructure = CourseFeeStructure::findOrFail($id);
        $feeStructure->delete();

        return redirect()->route('admin.course-fee-structures.index')
            ->with('success', __('Course fee structure deleted successfully'));
    }
}
