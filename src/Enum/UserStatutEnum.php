<?php

namespace App\Enum;

enum UserStatutEnum: string
{
    case ACTIVE = 'actif';
    case BANNED = 'banni';
    case SUSPENDED = 'suspendu';

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Actif',
            self::BANNED => 'Banni',
            self::SUSPENDED => 'Suspendu',
        };
    }

    /**
     * Compat rétro.
     */
    public function getLable(): string
    {
        return $this->getLabel();
    }

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::ACTIVE => 'emerald',
            self::BANNED => 'rose',
            self::SUSPENDED => 'amber',
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
