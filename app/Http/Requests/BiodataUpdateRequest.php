<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiodataUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * College-mandatory biodata validation rules.
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:32'],
            'phone_alt' => ['nullable', 'string', 'max:32'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'nationality' => ['required', 'string', 'max:100'],
            'id_number' => ['nullable', 'string', 'max:64'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'emergency_contact_name' => ['required', 'string', 'max:120'],
            'emergency_contact_phone' => ['required', 'string', 'max:32'],
        ];
    }

    public function attributes(): array
    {
        return [
            'phone' => 'phone number',
            'phone_alt' => 'alternate phone',
            'date_of_birth' => 'date of birth',
            'id_number' => 'ID / passport number',
            'address_line1' => 'address line 1',
            'address_line2' => 'address line 2',
            'emergency_contact_name' => 'emergency contact name',
            'emergency_contact_phone' => 'emergency contact phone',
        ];
    }
}
