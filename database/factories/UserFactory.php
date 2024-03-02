<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->name(),
            'middle_name' => $this->faker->text(255),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique->email(),
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => Str::random(10),
            'address' => $this->faker->address(),
            'designation' => $this->faker->text(255),
            'emergency_name' => $this->faker->text(255),
            'emergency_phone' => $this->faker->text(255),
            'emergency_address' => $this->faker->text(255),
            'height' => $this->faker->randomFloat(2, 0, 9999),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'genotype' => $this->faker->text(255),
            'blood_group' => $this->faker->text(255),
            'unique_id' => $this->faker->text(255),
            'role' => $this->faker->text(255),
            'clinic_id' => \App\Models\Clinic::factory(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
