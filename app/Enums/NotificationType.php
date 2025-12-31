<?php

namespace App\Enums;

enum NotificationType: string
{
    case VOLUNTEER = 'volunteer';
    case NOTIFICATION = 'notification';
    case ADOPTION = 'adoption';
    case ANIMAL = 'animal';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
