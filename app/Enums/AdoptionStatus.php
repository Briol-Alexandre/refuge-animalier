<?php

namespace App\Enums;

enum AdoptionStatus: string
{

    case CLOSED = 'closed';
    case PENDING = 'pending';
    case ARCHIVED = 'archived';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
