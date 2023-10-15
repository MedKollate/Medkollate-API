<?php

namespace App\Http\Resources\Clinic;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
			'clinic_name' => $this->clinic_name,
			'address' => $this->address,
			'local_govt' => $this->local_govt,
			'state' => $this->state,
			'reg_number' => $this->reg_number,
			'no_staff' => $this->no_staff,
			'no_dept' => $this->no_dept,
			'logo' => $this->logo,
			'payment' => $this->payment,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
