<?php

namespace App\Enum;

enum BracketSlotEnum: string
{
    case A = 'a';
    case B = 'b';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::A => 'blue',
            self::B => 'rose',
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
