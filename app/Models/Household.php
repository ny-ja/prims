<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'head_of_household_id',
        'household_street_address',
        'barangay',
        'city',
        'province',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Resident (the head of household)
    public function headOfHousehold()
    {
        return $this->belongsTo(Resident::class, 'head_of_household_id');
    }

    // Relationship with Dependents
    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }
}
