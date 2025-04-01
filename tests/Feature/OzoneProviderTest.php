<?php

namespace Tests\Feature;

use App\Services\OzoneServiceProvider\OzoneProvider;
use App\Services\WeatherServiceProvider\Enums\WeatherCode;
use App\Services\WeatherServiceProvider\WeatherData;
use App\Services\WeatherServiceProvider\WeatherProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class OzoneProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_ozone_provider_execution(): void
    {
        $weatherProvider= Mockery::mock(WeatherProvider::class);

        $weatherResponse =  new WeatherData(
            new \DateTime('2025-03-11T12:00'),
            10.5,
            50,
            WeatherCode::fromCode(3)
        );

        $weatherProvider
            ->shouldReceive('getCurrentWeather')
            ->once()
            ->andReturn($weatherResponse);

        $ozoneProvider = new OzoneProvider($weatherProvider);

        $ozoneProvider->processWeatherAndOzone();

        $this->assertDatabaseCount('observations', 1);
        $this->assertDatabaseHas(
            'observations',
            [
                'datetime' => '2025-03-11 12:00:00',
                'temperature' => 10.5,
                'cloud_cover' => 50,
                'weather_code' => 3,
                'ozone' => 278.15,
            ],
        );
    }
}
