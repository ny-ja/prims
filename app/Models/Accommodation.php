<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_owner_name',
        'property_owner_contact_number',
        'property_owner_email',
        'property_address',
    ];

    // Relationship with Accommodation Tenants
    public function tenants()
    {
        return $this->hasMany(AccommodationTenant::class);
    }
}
