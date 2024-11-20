<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'family_name',
        'contact_number',
        'email',
        'birthday',
        'birthplace',
        'blood_type',
        'sex',
        'street_address',
        'employment_status',
        'employment_sector',
        'educational_attainment',
        'course',
        'social_classification',
        'voter_status',
        'civil_status',
        'spouse_name',
        'spouse_employment_status',
        'spouse_employment_sector',
        'spouse_educational_attainment',
        'spouse_course',
        'resident_profile_photo_path'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Household (head of household)
    public function household()
    {
        return $this->hasOne(Household::class, 'head_of_household_id');
    }

    // Relationship with Accommodation Tenant (resident as a tenant)
    public function accommodationTenant()
    {
        return $this->hasMany(AccommodationTenant::class);
    }
}
