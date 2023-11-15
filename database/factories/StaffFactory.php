<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
			'middle_name' => $this->faker->firstName(),
			'last_name' => $this->faker->firstName(),
			'phone_number' => $this->faker->firstName(),
			'address' => $this->faker->firstName(),
			'email' => $this->faker->safeEmail(),
			'dept' => $this->faker->firstName(),
			'designation' => $this->faker->firstName(),
			'emergency_contact' => $this->faker->firstName(),
			'emargency_addr' => $this->faker->firstName(),
			'emergency_phone' => $this->faker->randomNumber(),
			'unique_id' => createOrRandomFactory(\App\Models\Unique::class),
			'profile_pic' => $this->faker->firstName(),
			'signature' => $this->faker->firstName(),
        ];
    }
}
