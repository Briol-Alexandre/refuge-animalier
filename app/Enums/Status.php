<?php

namespace App\Enums;

enum Status: string
{
    case AVAILABLE = 'available';

    case IN_ADOPTION = 'in_adoption';
    case ADOPTED = 'adopted';
    case PENDING = 'pending';
    case ARCHIVED = 'archived';
    case IN_CURE = 'in_cure';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Disponible',
            self::ADOPTED => 'Adopté',
            self::IN_ADOPTION => 'En cours d‘adoption',
            self::PENDING => 'En attente',
            self::ARCHIVED => 'Archivé',
            self::IN_CURE => 'En soins',
        };
    }
}
