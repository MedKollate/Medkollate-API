<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
			'middle_name' => $this->middle_name,
			'last_name' => $this->last_name,
			'phone_number' => $this->phone_number,
			'address' => $this->address,
			'email' => $this->email,
			'dept' => $this->dept,
			'designation' => $this->designation,
			'emergency_contact' => $this->emergency_contact,
			'emargency_addr' => $this->emargency_addr,
			'emergency_phone' => $this->emergency_phone,
			'unique_id' => $this->unique_id,
			'profile_pic' => $this->profile_pic,
			'signature' => $this->signature,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
