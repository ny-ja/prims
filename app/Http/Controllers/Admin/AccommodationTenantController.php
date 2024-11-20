<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\AccommodationTenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;

class AccommodationTenantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $residents = Resident::all();
        $accommodations = Accommodation::all();

        $tenants = AccommodationTenant::with('resident', 'accommodation')->when($search, function ($query, $search) {
            return $query->whereHas('resident', function ($residentQuery) use ($search) {
                $residentQuery->where('family_name', 'like', '%' . $search . '%');
            });
        })->latest()->paginate(10);

        return Inertia::render('Admin/AccommodationTenants/Index', [
            'tenants' => $tenants,
            'residents' => $residents,
            'accommodations' => $accommodations,
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(StoreTenantRequest $request)
    {
        $request->user()->accommodationTenant()->create($request->validated());

        return redirect()->back();
    }

    public function update(UpdateTenantRequest $request, AccommodationTenant $tenant)
    {
        $tenant->update($request->validated());

        return redirect()->back();
    }

    public function destroy(AccommodationTenant $tenant)
    {
        $tenant->delete();

        return redirect()->back();
    }
}
