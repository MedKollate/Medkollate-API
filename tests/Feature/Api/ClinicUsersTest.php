<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clinic;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicUsersTest extends TestCase
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
    public function it_gets_clinic_users(): void
    {
        $clinic = Clinic::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'clinic_id' => $clinic->id,
            ]);

        $response = $this->getJson(route('api.clinics.users.index', $clinic));

        $response->assertOk()->assertSee($users[0]->first_name);
    }

    /**
     * @test
     */
    public function it_stores_the_clinic_users(): void
    {
        $clinic = Clinic::factory()->create();
        $data = User::factory()
            ->make([
                'clinic_id' => $clinic->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.clinics.users.store', $clinic),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['profile_photo_path']);
        unset($data['middle_name']);
        unset($data['last_name']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($clinic->id, $user->clinic_id);
    }
}
