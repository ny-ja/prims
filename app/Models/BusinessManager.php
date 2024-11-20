<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_establishment_id',
        'manager_name',
        'manager_contact_number',
        'manager_email',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Business Establishment
    public function businessEstablishment()
    {
        return $this->belongsTo(BusinessEstablishment::class);
    }
}
