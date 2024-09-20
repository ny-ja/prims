<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BusinessManager;
use App\Http\Controllers\Controller;
use App\Models\BusinessEstablishment;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;

class BusinessManagerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $establishments = BusinessEstablishment::all();

        $managers = BusinessManager::with('businessEstablishment')->when($search, function ($query, $search) {
            return $query->where('manager_name', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return Inertia::render('Admin/BusinessManagers/Index', [
            'managers' => $managers,
            'establishments' => $establishments,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreManagerRequest $request)
    {
        BusinessManager::create($request->validated());

        return redirect()->back();
    }

    public function update(UpdateManagerRequest $request, BusinessManager $manager)
    {
        $manager->update($request->validated());

        return redirect()->back();
    }

    public function destroy(BusinessManager $manager)
    {
        $manager->delete();

        return redirect()->back();
    }
}
