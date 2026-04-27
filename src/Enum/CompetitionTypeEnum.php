<?php

namespace App\Enum;

enum CompetitionTypeEnum: string
{
    case LEAGUE = 'league';
    case CUP = 'cup';
    case SWISS = 'swiss';
    case DOUBLE_ELIMINATION = 'double_elimination';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::LEAGUE => 'indigo',
            self::CUP => 'amber',
            self::SWISS => 'cyan',
            self::DOUBLE_ELIMINATION => 'rose',
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
