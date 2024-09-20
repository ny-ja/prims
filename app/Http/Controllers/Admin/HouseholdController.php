<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseholdRequest;
use App\Http\Requests\UpdateHouseholdRequest;
use App\Models\Resident;

class HouseholdController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $headOfHouseholds = Resident::all();

        $households = Household::with('headOfHousehold')->when($search, function ($query, $search) {
            return $query->whereHas('headOfHousehold', function ($residentQuery) use ($search) {
                $residentQuery->where('family_name', 'like', '%' . $search . '%');
            });
        })->latest()->paginate(10);

        return Inertia::render('Admin/Households/Index', [
            'households' => $households,
            'headOfHouseholds' => $headOfHouseholds,
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(StoreHouseholdRequest $request)
    {
        Household::create($request->validated());

        return redirect()->back();
    }

    public function update(UpdateHouseholdRequest $request, Household $household)
    {
        $household->update($request->validated());

        return redirect()->back();
    }

    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()->back();
    }

    public function getHouseholdDependents($householdId)
    {
        // Fetch the household along with its dependents
        $household = Household::with('dependents')->findOrFail($householdId);

        // Pass the data to an Inertia component
        return Inertia::render('Admin/Households/Dependents', [
            'household' => $household,
            'dependents' => $household->dependents,
        ]);
    }
}
