<?php

namespace App\Enum;

enum TeamMemberRoleEnum: string
{
    case CAPTAIN = 'captain';
    case VICE_CAPTAIN = 'vice_captain';
    case MEMBER = 'member';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::CAPTAIN => 'amber',
            self::VICE_CAPTAIN => 'sky',
            self::MEMBER => 'slate',
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
