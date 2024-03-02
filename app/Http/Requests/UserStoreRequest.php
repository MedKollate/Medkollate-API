<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'address' => ['nullable', 'max:255', 'string'],
            'designation' => ['nullable', 'max:255', 'string'],
            'emergency_name' => ['nullable', 'max:255', 'string'],
            'emergency_phone' => ['nullable', 'max:255', 'string'],
            'emergency_address' => ['nullable', 'max:255', 'string'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'genotype' => ['nullable', 'max:255', 'string'],
            'blood_group' => ['nullable', 'max:255', 'string'],
            'unique_id' => ['nullable', 'max:255', 'string'],
            'role' => ['required', 'max:255', 'string'],
            'clinic_id' => ['nullable', 'exists:clinics,id'],
        ];
    }
}
