<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
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
        $residentId = $this->route('resident')->id;

        return [
            'first_name' => 'required|string|max:30',
            'middle_name' => 'required|string|max:30',
            'family_name' => 'required|string|max:30',
            'contact_number' => 'required|string|max:15',
            'email' => 'nullable|string|email|max:255|unique:residents,email,' . $residentId,
            'birthday' => 'required|date',
            'birthplace' => 'required|string',
            'blood_type' => 'required|string',
            'sex' => 'required|string',
            'street_address' => 'required|string',
            'employment_status' => 'required|string',
            'employment_sector' => 'required|string',
            'educational_attainment' => 'required|string',
            'course' => 'required|string',
            'social_classification' => 'required|array',
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
