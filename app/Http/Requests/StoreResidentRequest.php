<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'family_name' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'nullable|string|email|unique:residents',
            'birthday' => 'required|date',
            'birthplace' => 'required|string',
            'blood_type' => 'required|string',
            'sex' => 'required|string',
            'street_address' => 'required|string',
            'employment_status' => 'required|string',
            'employment_sector' => 'required|string',
            'educational_attainment' => 'required|string',
            'course' => 'required|string',
            'social_classification' => 'required|string',
            'voter_status' => 'required|string',
            'civil_status' => 'required|string',
            'spouse_name' => 'nullable|string',
            'spouse_employment_status' => 'nullable|string',
            'spouse_employment_sector' => 'nullable|string',
            'spouse_educational_attainment' => 'nullable|string',
            'spouse_course' => 'nullable|string',
            'resident_profile_photo' => 'nullable|image',
        ];
    }
}
