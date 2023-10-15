<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes'],
			'clinic_name' => ['sometimes', 'string'],
			'address' => ['sometimes', 'string'],
			'local_govt' => ['sometimes', 'string'],
			'state' => ['sometimes', 'string'],
			'reg_number' => ['sometimes', 'string'],
			'no_staff' => ['sometimes', 'integer'],
			'no_dept' => ['sometimes', 'integer'],
			'logo' => ['sometimes', 'string'],
			'payment' => ['sometimes', 'string'],
        ];
    }
}
