<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Resident;
use App\Http\Controllers\Controller;
use App\Models\AccommodationTenant;
use App\Models\BusinessEstablishment;
use App\Models\Household;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        $households = Household::all();
        $tenants = AccommodationTenant::all();
        $establishments = BusinessEstablishment::all();

        // Calculate age distribution
        $ageDistribution = $residents->map(function ($resident) {
            $age = Carbon::parse($resident->birthday)->age;
            return $age;
        })->groupBy(function ($age) {
            if ($age <= 18) {
                return '0-18';
            } elseif ($age <= 35) {
                return '19-35';
            } elseif ($age <= 60) {
                return '36-60';
            } else {
                return '60+';
            }
        })->map->count();

        // Calculate civil status distribution
        $civilStatusDistribution = $residents->groupBy('civil_status')->map->count();

        // Calculate voters registration status distribution
        $votersRegistrationStatusDistribution = $residents->groupBy('voter_status')->map->count();

        // Calculate voters registration status distribution
        $sexDistribution = $residents->groupBy('sex')->map->count();

        // Calculate voters employment status distribution
        $employmentStatusDistribution = $residents->groupBy('employment_status')->map->count();

        // Calculate voters employment sector distribution
        $employmentSectorDistribution = $residents->groupBy('employment_sector')->map->count();

        return Inertia::render('Admin/Index', [
            'residents' => $residents,
            'households' => $households,
            'tenants' => $tenants,
            'establishments' => $establishments,
            'ageDistribution' => $ageDistribution,
            'civilStatusDistribution' => $civilStatusDistribution,
            'votersRegistrationStatusDistribution' => $votersRegistrationStatusDistribution,
            'sexDistribution' => $sexDistribution,
            'employmentStatusDistribution' => $employmentStatusDistribution,
            'employmentSectorDistribution' => $employmentSectorDistribution,
        ]);
    }
}
