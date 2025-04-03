<?php

namespace Tests\Feature;

use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ObservationsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_route(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_ozone_api_index(): void
    {
        Observation::factory()->create([
            'datetime' => '2025-03-11T12:00',
            'temperature' => 15,
        ]);

        $response = $this->get('/api/observations');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'temperature' => 15,
            'datetime' => '2025-03-11T12:00:00.000000Z'
        ]);
    }

    public function test_ozone_api_filter_without_params(): void
    {
        $response = $this->get('/api/observations/filter');

        $response->assertStatus(302);
    }
}
