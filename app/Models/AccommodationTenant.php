<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationTenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accommodation_id',
        'resident_id',
        'tenant_contact_number',
        'tenant_email',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Accommodation
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    // Relationship with Resident (the tenant)
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
