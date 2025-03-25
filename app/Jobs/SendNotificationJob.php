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

    private NotificationData $notification;

    /**
     * Create a new job instance.
     */
    public function __construct(NotificationProvider $provider)
    {
        // Publisher execution
        $this->notification = $provider->prepareNotification();

        // имя очереди (telegram or email) извлекается из объекта notification
        $this->onConnection('rabbitmq_notification');
        $this->onQueue($this->notification->mailService->toString());
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Consumer executing
        sleep(3);
        Log::info($this->notification);
    }
}
