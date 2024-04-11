<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Clinic;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicTest extends TestCase
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
    public function it_gets_clinics_list(): void
    {
        $clinics = Clinic::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.clinics.index'));

        $response->assertOk()->assertSee($clinics[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_clinic(): void
    {
        $data = Clinic::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.clinics.store'), $data);

        $this->assertDatabaseHas('clinics', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'local_gov' => $this->faker->text(255),
            'state' => $this->faker->state(),
            'reg_number' => $this->faker->text(255),
            'payment' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.clinics.update', $clinic), $data);

        $data['id'] = $clinic->id;

        $this->assertDatabaseHas('clinics', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_clinic(): void
    {
        $clinic = Clinic::factory()->create();

        $response = $this->deleteJson(route('api.clinics.destroy', $clinic));

        $this->assertModelMissing($clinic);

        $response->assertNoContent();
    }
}
