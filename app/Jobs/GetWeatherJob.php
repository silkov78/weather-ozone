<?php

namespace App\Jobs;

use App\Services\WeatherServiceProvider\WeatherData;
use App\Services\WeatherServiceProvider\WeatherProvider;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class GetWeatherJob implements ShouldQueue
{
    use Queueable;

    private WeatherData $weatherData;

    public function __construct(WeatherProvider $provider)
    {
        $this->onConnection('rabbitmq_weather');
        $this->onQueue(env('RABBITMQ_WEATHER_QUEUE'));

        $this->weatherData = $provider->getCurrentWeather();
    }

    public function handle(): void
    {
        sleep(3);

        Log::info($this->weatherData);
    }
}
