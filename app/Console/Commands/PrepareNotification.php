<?php

namespace App\Console\Commands;

use App\Services\NotificationServiceProvider\NotificationProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PrepareNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prepare-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(
        private NotificationProvider $notificationProvider
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        sleep(0.5);
        $notification = $this->notificationProvider->prepareNotification();

        Log::info($notification);
        echo $notification . PHP_EOL;
    }
}
