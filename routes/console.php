<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Schedule;
use \App\Jobs\GetWeatherJob;
use \App\Jobs\SendNotificationJob;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule
Schedule::job(GetWeatherJob::class)->everyTenSeconds();
Schedule::job(SendNotificationJob::class)->everyTenSeconds();
