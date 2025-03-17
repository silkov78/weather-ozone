<?php

namespace Tests\Unit\WeatherDataProvider;

use App\Services\WeatherServiceProvider\Enums\WeatherCode;
use App\Services\WeatherServiceProvider\WeatherData;
use PHPUnit\Framework\TestCase;

class WeatherDataTest extends TestCase
{
    public function test_weather_data_to_string(): void
    {
        $data = new WeatherData(
            new \DateTime('2025-03-11T12:00'),
            10.5,
            50,
            WeatherCode::fromCode(3)
        );

        $this->assertStringContainsString('12:00', (string) $data);
        $this->assertStringContainsString('10.5', (string) $data);
    }
}
