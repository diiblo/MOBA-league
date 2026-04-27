<?php

namespace App\Enum;

enum LineUpMemberRoleEnum: string
{
    case PLAYER = 'player';
    case SUBSTITUTE = 'substitute';
    case CAPTAIN = 'captain';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::PLAYER => 'indigo',
            self::SUBSTITUTE => 'slate',
            self::CAPTAIN => 'amber',
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
