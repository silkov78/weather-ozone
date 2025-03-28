<?php

namespace App\Console\Commands;

use App\Services\OzoneServiceProvider\OzoneProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessOzone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-ozone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the job.
     */
    public function handle(OzoneProvider $ozoneProvider): void
    {
        $ozoneProvider->processWeatherAndOzone();
        Log::info('Ozone processed');
    }
}
