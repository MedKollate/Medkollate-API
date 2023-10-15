<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => createOrRandomFactory(\App\Models\User::class),
			'clinic_name' => $this->faker->firstName(),
			'address' => $this->faker->firstName(),
			'local_govt' => $this->faker->firstName(),
			'state' => $this->faker->firstName(),
			'reg_number' => $this->faker->firstName(),
			'no_staff' => $this->faker->randomNumber(),
			'no_dept' => $this->faker->randomNumber(),
			'logo' => $this->faker->firstName(),
			'payment' => $this->faker->firstName(),
        ];
    }
}
