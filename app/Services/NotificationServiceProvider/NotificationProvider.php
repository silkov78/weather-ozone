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

        $mailServices = ['email', 'telegram'];
        $mailService = MailService::fromString(
            $mailServices[random_int(0, 1)]
        );

        return new NotificationData(
            $dateTime, $userId, $message, $mailService
        );
    }
}
