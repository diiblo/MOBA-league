<?php

namespace App\Enum;

enum FixtureOpponentStatusEnum: string
{
    case SET = 'set';
    case TBD = 'tbd';
    case BYE = 'bye';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::SET => 'emerald',
            self::TBD => 'amber',
            self::BYE => 'zinc',
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
