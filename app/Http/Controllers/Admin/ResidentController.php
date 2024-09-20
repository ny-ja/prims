<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Exports\ResidentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $voterStatus = $request->input('voter_status');

        if ($request->has('export')) {
            return Excel::download(new ResidentsExport($search, $voterStatus), 'residents.xlsx');
        }

        $residents = Resident::when($search, function ($query, $search) {
                return $query->where('family_name', 'like', '%' . $search . '%');
            })
            ->when($voterStatus, function ($query, $voterStatus) {
                return $query->where('voter_status', $voterStatus);
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Residents/Index', [
            'residents' => $residents,
            'filters' => $request->only(['search', 'voter_status']),
        ]);
    }

    public function store(StoreResidentRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('resident_profile_photo') ? $request->file('resident_profile_photo')->store('resident_profile_photos', 'public') : null;
        $validatedData['resident_profile_photo_path'] = $path;
        
        Resident::create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateResidentRequest $request, Resident $resident)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('resident_profile_photo')) {
            // Delete the old news photo if it exists
            if ($resident->resident_profile_photo_path) {
                Storage::disk('public')->delete($resident->resident_profile_photo_path);
            }
            $path = $request->file('resident_profile_photo')->store('resident_profile_photos', 'public');
            $validatedData['resident_profile_photo_path'] = $path;
        }

        $resident->update($validatedData);

        return redirect()->back();
    }

    public function show(Resident $resident)
    {
        return Inertia::render('Admin/Residents/Show', [
            'resident' => $resident,
        ]);
    }

    public function destroy(Resident $resident)
    {
        if ($resident->resident_profile_photo_path) {
            Storage::disk('public')->delete($resident->resident_profile_photo_path);
        }

        $resident->delete();

        return redirect()->back();
    }
}