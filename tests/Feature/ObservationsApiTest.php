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
            'datetime' => new \DateTime('2025-01-01 12:00:00'),
            'temperature' => 5,
            'cloud_cover' => 10,
        ]);

        $response = $this->get('/api/observations');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'datetime' => '2025-01-01 12:00:00',
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

    public function test_filter_by_date_method_success(): void
    {
        Observation::factory()->create([
            'datetime' => new \DateTime('2025-01-01 12:00:00'),
            'temperature' => 5,
        ]);

        $response = $this->get(
            '/api/observations/filter?start_date=1900-01-01&end_date=2030-12-31'
        );

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'datetime' => '2025-01-01 12:00:00',
            'temperature' => 5,
        ]);
    }

    public function test_filter_by_date_method_with_empty_db(): void
    {
        $response = $this->get(
            '/api/observations/filter?start_date=1900-01-01&end_date=2030-12-31'
        );

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Observations are not found.'
        ]);
    }

    public function test_filter_by_date_method_without_query_params(): void
    {
        $response = $this->get(
            '/api/observations/filter'
        );

        $response->assertStatus(400);
        $response->assertJsonFragment([
            'message' => 'Invalid query parameters.'
        ]);
    }
}
