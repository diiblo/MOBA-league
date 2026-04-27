<?php

namespace App\Enum;

enum DisputeStatusEnum: string
{
    case OPEN = 'open';
    case UNDER_REVIEW = 'under_review';
    case RESOLVED = 'resolved';
    case DISMISSED = 'dismissed';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::OPEN => 'amber',
            self::UNDER_REVIEW => 'violet',
            self::RESOLVED => 'emerald',
            self::DISMISSED => 'zinc',
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
