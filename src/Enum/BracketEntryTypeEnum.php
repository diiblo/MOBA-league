<?php

namespace App\Enum;

enum BracketEntryTypeEnum: string
{
    case DIRECT = 'direct';
    case FROM_NODE = 'from_node';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::DIRECT => 'emerald',
            self::FROM_NODE => 'indigo',
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
