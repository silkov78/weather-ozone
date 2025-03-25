<?php

declare(strict_types=1);

namespace App\Services\NotificationServiceProvider;

enum MailService: string
{
    case EMAIL = 'email';
    case TELEGRAM = 'telegram';
    case UNDEFINED = 'undefined';

    public static function fromString(string $mailService): self
    {
        return self::tryFrom($mailService) ?? self::UNDEFINED;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
