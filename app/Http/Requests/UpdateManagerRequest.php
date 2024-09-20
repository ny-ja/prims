<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManagerRequest extends FormRequest
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
        $managerId = $this->route('manager')->id;

        return [
            'business_establishment_id' => 'required|exists:business_establishments,id',
            'manager_name' => 'required|string|max:255',
            'manager_contact_number' => 'required|string|max:15',
            'manager_email' => 'nullable|string|email|max:255|unique:business_managers,manager_email,' . $managerId,
        ];
    }
}
