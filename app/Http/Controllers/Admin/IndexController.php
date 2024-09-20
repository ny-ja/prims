<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\AccommodationTenant;
use App\Http\Controllers\Controller;
use App\Models\Accommodation;

class IndexController extends Controller
{
    public function index(){

        $residents = Resident::all();
        $households = Household::all();
        $tenants = AccommodationTenant::all();
        $accommodations = Accommodation::all();

        // Fetch households without dependents
        $householdsWithoutDependents = Household::doesntHave('dependents')->with('headOfHousehold')->get();

        // Fetch residents with accommodation tenancies
        $residentsWithTenancies = AccommodationTenant::with('resident', 'accommodation')->get();

        // Fetch voters and non-voters separately
        $voters = Resident::where('voter_status', 'Registered Voter')->select('first_name', 'family_name', 'voter_status')->get();
        $nonVoters = Resident::where('voter_status', 'Non-Registered Voter')->select('first_name', 'family_name', 'voter_status')->get();
        
        return Inertia::render('Admin/Index', [
            'householdsWithoutDependents' => $householdsWithoutDependents,
            'residentsWithTenancies' => $residentsWithTenancies,
            'voters' => $voters,
            'nonVoters' => $nonVoters,
            'residents' => $residents,
            'households' => $households,
            'tenants' => $tenants,
            'accommodations' => $accommodations,
        ]);
    }
}
