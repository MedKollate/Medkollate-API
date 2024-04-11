<?php

namespace Tests\Feature\Api;

use App\Models\User;

use App\Models\Clinic;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_users_list(): void
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.users.index'));

        $response->assertOk()->assertSee($users[0]->first_name);
    }

    /**
     * @test
     */
    public function it_stores_the_user(): void
    {
        $data = User::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.users.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['profile_photo_path']);
        unset($data['middle_name']);
        unset($data['last_name']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user(): void
    {
        $user = User::factory()->create();

        $clinic = Clinic::factory()->create();

        $data = [
            'first_name' => $this->faker->name(),
            'middle_name' => $this->faker->text(255),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique->email(),
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
            'clinic_id' => $clinic->id,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(route('api.users.update', $user), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['profile_photo_path']);
        unset($data['middle_name']);
        unset($data['last_name']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('api.users.destroy', $user));

        $this->assertModelMissing($user);

        $response->assertNoContent();
    }
}
