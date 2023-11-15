<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'username' => ['sometimes', 'string'],
            'first_name' => ['sometimes', 'string'],
			'middle_name' => ['sometimes', 'string'],
			'last_name' => ['sometimes', 'string'],
			'phone_number' => ['sometimes', 'string'],
			'address' => ['sometimes', 'string'],
			'email' => ['sometimes', 'email', 'string'],
			'dept' => ['sometimes', 'string'],
			'designation' => ['sometimes', 'string'],
			'emergency_contact' => ['sometimes', 'string'],
			'emargency_addr' => ['sometimes', 'string'],
			'emergency_phone' => ['sometimes', 'integer'],
			// 'unique_id' => ['sometimes', 'string'],
			'profile_pic' => ['sometimes', 'string'],
			'signature' => ['sometimes', 'string'],
        ];
    }
}
