<?php

namespace App\Enum;

enum BracketOutcomeEnum: string
{
    case WINNER = 'winner';
    case LOSER = 'loser';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::WINNER => 'emerald',
            self::LOSER => 'rose',
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
