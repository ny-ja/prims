<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_establishment_id',
        'manager_name',
        'manager_contact_number',
        'manager_email',
    ];

    // Relationship with Business Establishment
    public function businessEstablishment()
    {
        return $this->belongsTo(BusinessEstablishment::class);
    }
}
