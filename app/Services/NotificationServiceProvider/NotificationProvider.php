<?php

declare(strict_types=1);

namespace App\Services\NotificationServiceProvider;

class NotificationProvider
{
    public function prepareNotification(): NotificationData
    {
        $dateTime = new \DateTime();
        $userId = random_int(0, 100);
        $message = "Hello, user {$userId}!";
        $mailService = MailService::fromMailServiceName(random_int(1, 2));

        return new NotificationData(
            $dateTime, $userId, $message, $mailService
        );
    }
}
