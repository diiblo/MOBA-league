<?php

namespace App\Enum;

enum VenueSlotStatusEnum: string
{
    case AVAILABLE = 'available';
    case BOOKED = 'booked';
    case BLOCKED = 'blocked';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::AVAILABLE => 'emerald',
            self::BOOKED => 'sky',
            self::BLOCKED => 'rose',
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
