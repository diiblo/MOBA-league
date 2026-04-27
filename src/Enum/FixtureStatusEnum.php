<?php

namespace App\Enum;

enum FixtureStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case ONGOING = 'ongoing';
    case PENDING_REVIEW = 'pending_review';
    case VALIDATED = 'validated';
    case REJECTED = 'rejected';
    case FORFEITED = 'forfeited';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::SCHEDULED => 'sky',
            self::ONGOING => 'violet',
            self::PENDING_REVIEW => 'amber',
            self::VALIDATED => 'emerald',
            self::REJECTED => 'rose',
            self::FORFEITED => 'orange',
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
