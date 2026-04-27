<?php

namespace App\Enum;

enum StreamLanguageEnum: string
{
    case EN = 'en';
    case FR = 'fr';
    case ES = 'es';
    case DE = 'de';
    case OTHER = 'other';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::EN => 'sky',
            self::FR => 'indigo',
            self::ES => 'amber',
            self::DE => 'orange',
            self::OTHER => 'zinc',
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
