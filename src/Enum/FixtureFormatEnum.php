<?php

namespace App\Enum;

enum FixtureFormatEnum: string
{
    case BO1 = 'bo1';
    case BO3 = 'bo3';
    case BO5 = 'bo5';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::BO1 => 'slate',
            self::BO3 => 'indigo',
            self::BO5 => 'fuchsia',
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
