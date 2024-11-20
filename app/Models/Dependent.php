<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'household_id',
        'first_name',
        'middle_name',
        'family_name',
        'birthday',
        'birthplace',
        'blood_type',
        'sex',
        'educational_attainment',
        'course',
        'relationship_to_head',
        'dependent_profile_photo_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Household
    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
