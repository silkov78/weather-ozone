<?php

namespace Tests\Feature;

use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ObservationsApiTest extends TestCase
{
    use RefreshDatabase;

    public string $uri = 'api/v1/observations';

    public function test_index_method_success(): void
    {
        Observation::factory()->create([
            'datetime' => new \DateTime('2025-01-01 12:00:00'),
            'temperature' => 5,
            'cloud_cover' => 10,
        ]);

        $response = $this->get($this->uri);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'datetime' => '2025-01-01 12:00:00',
            'temperature' => 5,
            'cloud_cover' => 10,
        ]);
    }

    public function test_index_method_with_unfound_row(): void
    {
        $response = $this->get($this->uri);

        $response->assertStatus(404);
        $response->assertJsonFragment([
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
            $this->uri . '/filter?start_date=1900-01-01&end_date=2030-12-31'
        );

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'datetime' => '2025-01-01 12:00:00',
            'temperature' => 5,
        ]);
    }

    public function test_filter_by_date_method_with_unfound_rows(): void
    {
        $response = $this->get(
            $this->uri . '/filter?start_date=1900-01-01&end_date=2030-12-31'
        );

        $response->assertStatus(404);
        $response->assertJsonFragment([
            'message' => 'Observations from date range are not found.'
        ]);
    }

    public static function invalidQueryParamsCases(): array
    {
        return [
            'empty query params' => [''],
            'without start_date' => ['?end_date=2030-12-31'],
            'without end_date' => ['?start_date=2010-12-31'],
            'end_date before start_date' => ['?start_date=2030-01-01&end_date=2020-12-31'],
            'not date type' => ['?start_date=2030-01-01adf&end_date=5'],
            'invalid date format' => ['?start_date=2020.01.01&end_date=2030.12.31'],
        ];
    }

    #[DataProvider('invalidQueryParamsCases')]
    public function test_filter_by_date_method_with_invalid_query($queryString): void
    {
        $url = '/api/observations/filter' . $queryString;
        $response = $this->get($this->uri . '/filter' . $queryString);

        $response->assertStatus(400);
        $response->assertJsonFragment([
            'message' => 'Invalid query parameters.'
        ]);
    }
}
