<?php

namespace App\Enums;

abstract class MailEncryption
{
    const TLS = 'tls';
    const SSL = 'ssl';

    public static function values(): array
    {
        return [
            self::TLS,
            self::SSL,
        ];
    }
}
