<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Schedule;
use \App\Jobs\ProcessOzoneJob;
use \App\Jobs\SendNotificationJob;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule
//Schedule::job(ProcessOzoneJob::class)->everyMinute();
//Schedule::job(SendNotificationJob::class)->everyTenSeconds();
