<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'username' => ['required', 'string'],
            'first_name' => ['required', 'string'],
			'middle_name' => ['nullable', 'string'],
			'last_name' => ['nullable', 'string'],
			'phone_number' => ['nullable', 'string'],
			'address' => ['nullable', 'string'],
			'email' => ['required', 'email', 'string'],
			'dept' => ['required', 'string'],
			'designation' => ['required', 'string'],
			'emergency_contact' => ['nullable', 'string'],
			'emargency_addr' => ['nullable', 'string'],
			'emergency_phone' => ['nullable', 'integer'],
			// 'unique_id' => ['required', 'string'],
			'profile_pic' => ['nullable', 'string'],
			'signature' => ['nullable', 'string'],
        ];
    }
}
