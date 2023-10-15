<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class CreateClinicRequest extends FormRequest
{
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			$this->merge([
				'user_id' => auth()->id()
			]);
		});
	}
	public function rules(): array
	{
		return [
			// 'user_id' => ['required'],
			'clinic_name' => ['required', 'string'],
			'address' => ['required', 'string'],
			'local_govt' => ['required', 'string'],
			'state' => ['required', 'string'],
			'reg_number' => ['required', 'string'],
			'no_staff' => ['required', 'integer'],
			'no_dept' => ['required', 'integer'],
			'logo' => ['required', 'string'],
			'payment' => ['required', 'string'],
		];
	}
}
