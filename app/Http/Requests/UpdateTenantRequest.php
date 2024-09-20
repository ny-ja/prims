<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
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
        $tenantId = $this->route('tenant')->id;

        return [
            'accommodation_id' => 'required|exists:accommodations,id',
            'resident_id' => 'required|exists:residents,id',
            'tenant_contact_number' => 'required|string|max:15',
            'tenant_email' => 'nullable|string|email|max:255|unique:accommodation_tenants,tenant_email,' . $tenantId,
        ];
    }
}
