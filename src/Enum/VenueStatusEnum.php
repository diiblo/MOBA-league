<?php

namespace App\Enum;

enum VenueStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case MAINTENANCE = 'maintenance';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::ACTIVE => 'emerald',
            self::INACTIVE => 'zinc',
            self::MAINTENANCE => 'amber',
        };
    }

    /** Conversion string → Enum (retourne null si invalide) */
    public static function fromString(?string $value): ?self
    {
        if (null === $value) {
            return null;
        }

        return self::tryFrom($value);
    }

    /** Toutes les valeurs sous forme de tableau de strings */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
