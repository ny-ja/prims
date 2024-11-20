<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Dependent;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDependentRequest;
use App\Http\Requests\UpdateDependentRequest;

class DependentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch households with their respective head of household's full name
        $households = Household::with('headOfHousehold:id,first_name,middle_name,family_name')->get();

        // Fetch dependents and search based on family_name, including the household data
        $dependents = Dependent::with('household.headOfHousehold') // Load household with the head of household relationship
            ->when($search, function ($query, $search) {
                return $query->where('family_name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Dependents/Index', [
            'dependents' => $dependents,
            'households' => $households,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreDependentRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('dependent_profile_photo') ? $request->file('dependent_profile_photo')->store('dependent_profile_photos', 'public') : null;
        $validatedData['dependent_profile_photo_path'] = $path;
        
        $request->user()->dependent()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateDependentRequest $request, Dependent $dependent)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('dependent_profile_photo')) {
            // Delete the old news photo if it exists
            if ($dependent->dependent_profile_photo_path) {
                Storage::disk('public')->delete($dependent->dependent_profile_photo_path);
            }
            $path = $request->file('dependent_profile_photo')->store('dependent_profile_photos', 'public');
            $validatedData['dependent_profile_photo_path'] = $path;
        }

        $dependent->update($validatedData);

        return redirect()->back();
    }

    public function show(Dependent $dependent)
    {
        // Load the household and headOfHousehold relationship for the dependent
        $dependent->load('household.headOfHousehold');

        return Inertia::render('Admin/Dependents/Show', [
            'dependent' => $dependent,
        ]);
    }

    public function destroy(Dependent $dependent)
    {
        if ($dependent->dependent_profile_photo_path) {
            Storage::disk('public')->delete($dependent->dependent_profile_photo_path);
        }

        $dependent->delete();

        return redirect()->back();
    }
}
