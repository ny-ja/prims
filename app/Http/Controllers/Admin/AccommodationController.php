<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;

class AccommodationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $accommodations = Accommodation::when($search, function ($query, $search) {
            return $query->where('property_owner_name', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return Inertia::render('Admin/Accommodations/Index', [
            'accommodations' => $accommodations,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreAccommodationRequest $request)
    {
        Accommodation::create($request->validated());

        return redirect()->back();
    }

    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $accommodation->update($request->validated());

        return redirect()->back();
    }

    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();

        return redirect()->back();
    }
}
