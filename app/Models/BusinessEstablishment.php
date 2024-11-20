<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEstablishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'owner_name',
        'owner_contact_number',
        'owner_email',
        'business_address',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Business Managers
    public function managers()
    {
        return $this->hasMany(BusinessManager::class);
    }
}
