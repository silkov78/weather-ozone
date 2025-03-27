<?php

declare(strict_types=1);

namespace App\Services\OzoneServiceProvider;

use App\Models\Observation;
use App\Services\WeatherServiceProvider\WeatherData;
use App\Services\WeatherServiceProvider\WeatherProvider;

readonly class OzoneProvider
{
    public function __construct(private WeatherProvider $weatherProvider) {}

    public function processWeatherAndOzone(): void
    {
        $weather = $this->weatherProvider->getCurrentWeather();
        $ozoneValue = $this->calculateOzoneValue($weather);

        Observation::create([
            'datetime' => $weather->dateTime,
            'temperature' => $weather->temperature,
            'cloud_cover' => $weather->cloudCover,
            'weather_code' => $weather->weatherCode->value,
            'ozone' => $ozoneValue,
        ]);
    }


    private function calculateOzoneValue(WeatherData $weather): float
    {
        $randValue = random_int(240, 400);
        $temperature = $weather->temperature * 0.3;
        $cloudCover = $weather->cloudCover / 100;

        return round($randValue + $temperature + $cloudCover, 2);
    }
}
