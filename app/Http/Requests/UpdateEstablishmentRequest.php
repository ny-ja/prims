<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstablishmentRequest extends FormRequest
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
        $establishmentId = $this->route('establishment')->id;

        return [
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_contact_number' => 'required|string|max:15',
            'owner_email' => 'nullable|string|email|max:255|unique:business_establishments,owner_email,' . $establishmentId,
            'business_address' => 'required|string|max:255',
        ];
    }
}
