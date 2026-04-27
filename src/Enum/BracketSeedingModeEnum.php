<?php

namespace App\Enum;

enum BracketSeedingModeEnum: string
{
    case RANDOM = 'random';
    case MANUAL = 'manual';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::RANDOM => 'fuchsia',
            self::MANUAL => 'sky',
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
