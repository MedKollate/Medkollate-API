<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'local_gov' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'reg_number' => ['required', 'max:255', 'string'],
            'payment' => ['required', 'max:255', 'string'],
        ];
    }
}
