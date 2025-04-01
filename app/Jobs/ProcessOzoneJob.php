<?php

namespace App\Jobs;

use App\Services\OzoneServiceProvider\OzoneProvider;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ProcessOzoneJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onConnection('rabbitmq_ozone');
        $this->onQueue(env('RABBITMQ_OZONE_QUEUE'));
    }

    /**
     * Execute the job.
     */
    public function handle(OzoneProvider $ozoneProvider): void
    {
        $ozoneProvider->processWeatherAndOzone();
        Log::info('Ozone processed');
    }
}
