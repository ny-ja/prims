<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessEstablishment;
use App\Http\Requests\StoreEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;

class BusinessEstablishmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $establishments = BusinessEstablishment::when($search, function ($query, $search) {
            return $query->where('business_name', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return Inertia::render('Admin/Establishments/Index', [
            'establishments' => $establishments,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreEstablishmentRequest $request)
    {
        BusinessEstablishment::create($request->validated());

        return redirect()->back();
    }

    public function update(UpdateEstablishmentRequest $request, BusinessEstablishment $establishment)
    {
        $establishment->update($request->validated());

        return redirect()->back();
    }

    public function destroy(BusinessEstablishment $establishment)
    {
        $establishment->delete();

        return redirect()->back();
    }
}
