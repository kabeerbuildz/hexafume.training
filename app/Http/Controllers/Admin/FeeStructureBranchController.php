<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeStructureBranch;
use Illuminate\Http\Request;

class FeeStructureBranchController extends Controller
{
    public function index()
    {
        $branches = FeeStructureBranch::orderBy('order')->orderBy('name')->paginate(15);
        return view('admin.fee-structure.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.fee-structure.branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'address' => 'required|string',
            'icon_color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $branch = new FeeStructureBranch();
        $branch->name = $request->name;
        $branch->tag = $request->tag;
        $branch->address = $request->address;
        $branch->icon_color = $request->icon_color;
        $branch->icon = $request->icon ?? 'fas fa-map-marker-alt';
        $branch->link = $request->link;
        $branch->order = $request->order ?? 0;
        $branch->status = $request->status;
        $branch->save();

        return redirect()->route('admin.fee-structure-branches.index')
            ->with('success', __('Branch created successfully'));
    }

    public function edit($id)
    {
        $branch = FeeStructureBranch::findOrFail($id);
        return view('admin.fee-structure.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'address' => 'required|string',
            'icon_color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $branch = FeeStructureBranch::findOrFail($id);
        $branch->name = $request->name;
        $branch->tag = $request->tag;
        $branch->address = $request->address;
        $branch->icon_color = $request->icon_color;
        $branch->icon = $request->icon ?? 'fas fa-map-marker-alt';
        $branch->link = $request->link;
        $branch->order = $request->order ?? 0;
        $branch->status = $request->status;
        $branch->save();

        return redirect()->route('admin.fee-structure-branches.index')
            ->with('success', __('Branch updated successfully'));
    }

    public function destroy($id)
    {
        $branch = FeeStructureBranch::findOrFail($id);
        $branch->delete();

        return redirect()->route('admin.fee-structure-branches.index')
            ->with('success', __('Branch deleted successfully'));
    }
}
