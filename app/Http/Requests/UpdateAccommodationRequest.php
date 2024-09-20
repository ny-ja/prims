<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccommodationRequest extends FormRequest
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
        $accommodationId = $this->route('accommodation')->id;

        return [
            'property_owner_name' => 'required|string|max:255',
            'property_owner_contact_number' => 'required|string|max:15',
            'property_owner_email' => 'nullable|string|email|max:255|unique:accommodations,property_owner_email,' . $accommodationId,
            'property_address' => 'required|string|max:255',
        ];
    }
}
