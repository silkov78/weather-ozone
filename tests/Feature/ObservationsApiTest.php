<?php

namespace Tests\Feature;

use App\Models\Observation;
use App\Services\WeatherServiceProvider\Enums\WeatherCode;
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

    public function test_index_method_success(): void
    {
        Observation::factory()->create([
            'datetime' => new \DateTime('2024-04-01 12:00:00'),
            'temperature' => 5,
            'cloud_cover' => 10,
        ]);

        $response = $this->get('/api/observations');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'datetime' => '2024-04-01 12:00:00',
            'temperature' => 5,
            'cloud_cover' => 10,
        ]);
    }

    public function test_index_method_with_empty_db(): void
    {
        $response = $this->get('/api/observations');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Observations are not found.'
        ]);
    }

}
