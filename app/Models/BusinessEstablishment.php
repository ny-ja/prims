<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEstablishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'owner_name',
        'owner_contact_number',
        'owner_email',
        'business_address',
    ];

    // Relationship with Business Managers
    public function managers()
    {
        return $this->hasMany(BusinessManager::class);
    }
}
