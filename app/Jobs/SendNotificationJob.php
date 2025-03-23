<?php

namespace App\Jobs;

use App\Services\NotificationServiceProvider\NotificationData;
use App\Services\NotificationServiceProvider\NotificationProvider;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationProvider $provider): void
    {
        $notification = $provider->prepareNotification();
        $this->onConnection('rabbitmq_notification');
        $this->onQueue('email');

        sleep(3);
        Log::info($notification);
    }
}
