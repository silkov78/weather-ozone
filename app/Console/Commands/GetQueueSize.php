<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class GetQueueSize extends Command
{
    protected $signature = 'app:get-queue-size';

    protected $description = 'Display the size of the specified Redis queue';


    public function handle(): void
    {
        $size = Queue::size();
        echo "Queue size: {$size}" . PHP_EOL;
    }
}
