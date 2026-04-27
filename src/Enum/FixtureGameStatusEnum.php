<?php

namespace App\Enum;

enum FixtureGameStatusEnum: string
{
    case PENDING = 'pending';
    case VALIDATED = 'validated';
    case REJECTED = 'rejected';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'amber',
            self::VALIDATED => 'emerald',
            self::REJECTED => 'rose',
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
