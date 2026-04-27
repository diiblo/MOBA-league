<?php

namespace App\Enum;

enum FixtureGameWinnerEnum: string
{
    case LINEUP_A = 'lineup_a';
    case LINEUP_B = 'lineup_b';
    case DRAW = 'draw';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::LINEUP_A => 'blue',
            self::LINEUP_B => 'rose',
            self::DRAW => 'zinc',
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
