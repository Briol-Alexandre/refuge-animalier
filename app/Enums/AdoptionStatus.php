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

    public function label(): string
    {
        return match ($this) {
            self::CLOSED => 'Clôturé',
            self::PENDING => 'En attente',
            self::ARCHIVED => 'Archivé',
        };
    }

    public static function fromLabel(string $label): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->label() === $label) {
                return $case;
            }
        }
        return null;
    }
}
