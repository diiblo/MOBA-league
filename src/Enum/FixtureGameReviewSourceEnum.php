<?php

namespace App\Enum;

enum FixtureGameReviewSourceEnum: string
{
    case AI = 'ai';
    case ADMIN = 'admin';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::AI => 'violet',
            self::ADMIN => 'sky',
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
