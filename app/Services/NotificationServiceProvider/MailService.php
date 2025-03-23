<?php

declare(strict_types=1);

namespace App\Services\NotificationServiceProvider;

enum MailService: int
{
    case EMAIL = 1;
    case TELEGRAM = 2;
    case UNDEFINED = 0;

    public static function fromMailServiceName(int $mailServiceName): self
    {
        return self::tryFrom($mailServiceName) ?? self::UNDEFINED;
    }
}
