<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDependentRequest extends FormRequest
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
            'household_id' => 'required|exists:households,id',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'family_name' => 'required|string',
            'birthday' => 'required|date',
            'birthplace' => 'required|string',
            'blood_type' => 'required|string',
            'sex' => 'required|string',
            'educational_attainment' => 'required|string',
            'course' => 'required|string',
            'relationship_to_head' => 'required|string',
            'dependent_profile_photo' => 'nullable|image',
        ];
    }
}
