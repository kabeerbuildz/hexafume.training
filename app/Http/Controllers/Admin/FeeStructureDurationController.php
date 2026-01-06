<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeStructureDuration;
use Illuminate\Http\Request;

class FeeStructureDurationController extends Controller
{
    public function index()
    {
        $durations = FeeStructureDuration::orderBy('order')->orderBy('value')->paginate(15);
        return view('admin.fee-structure.durations.index', compact('durations'));
    }

    public function create()
    {
        return view('admin.fee-structure.durations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $duration = new FeeStructureDuration();
        $duration->name = $request->name;
        $duration->value = $request->value;
        $duration->order = $request->order ?? 0;
        $duration->status = $request->status;
        $duration->save();

        return redirect()->route('admin.fee-structure-durations.index')
            ->with('success', __('Duration created successfully'));
    }

    public function edit($id)
    {
        $duration = FeeStructureDuration::findOrFail($id);
        return view('admin.fee-structure.durations.edit', compact('duration'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $duration = FeeStructureDuration::findOrFail($id);
        $duration->name = $request->name;
        $duration->value = $request->value;
        $duration->order = $request->order ?? 0;
        $duration->status = $request->status;
        $duration->save();

        return redirect()->route('admin.fee-structure-durations.index')
            ->with('success', __('Duration updated successfully'));
    }

    public function destroy($id)
    {
        $duration = FeeStructureDuration::findOrFail($id);
        $duration->delete();

        return redirect()->route('admin.fee-structure-durations.index')
            ->with('success', __('Duration deleted successfully'));
    }
}
