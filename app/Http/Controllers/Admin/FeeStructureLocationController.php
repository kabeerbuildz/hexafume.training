<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeStructureLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeeStructureLocationController extends Controller
{
    public function index()
    {
        $locations = FeeStructureLocation::orderBy('order')->orderBy('name')->paginate(15);
        return view('admin.fee-structure.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.fee-structure.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $location = new FeeStructureLocation();
        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->order = $request->order ?? 0;
        $location->status = $request->status;
        $location->save();

        return redirect()->route('admin.fee-structure-locations.index')
            ->with('success', __('Location created successfully'));
    }

    public function edit($id)
    {
        $location = FeeStructureLocation::findOrFail($id);
        return view('admin.fee-structure.locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $location = FeeStructureLocation::findOrFail($id);
        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->order = $request->order ?? 0;
        $location->status = $request->status;
        $location->save();

        return redirect()->route('admin.fee-structure-locations.index')
            ->with('success', __('Location updated successfully'));
    }

    public function destroy($id)
    {
        $location = FeeStructureLocation::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.fee-structure-locations.index')
            ->with('success', __('Location deleted successfully'));
    }
}
