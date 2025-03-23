<?php

declare(strict_types=1);

namespace App\Services\NotificationServiceProvider;

readonly class NotificationData
{
    public function __construct(
        public \DateTime   $dateTime,
        public int $userId,
        public string $message,
        public MailService $mailService,
    ) {
    }

    public function __toString(): string
    {
        return "UserId: {$this->userId}, " .
               "message: {$this->message}, " .
               "mailService: {$this->mailService->toString()}";
    }
}
