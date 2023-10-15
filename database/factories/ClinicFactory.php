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
			'address' => $this->faker->streetAddress(),
			'local_govt' => $this->faker->city(),
			'state' => $this->faker->state(),
			'reg_number' => $this->faker->randomNumber(),
			'no_staff' => $this->faker->randomNumber(),
			'no_dept' => $this->faker->randomNumber(),
			'logo' => $this->faker->firstName(),
			'payment' => $this->faker->firstName(),
        ];
    }
}
