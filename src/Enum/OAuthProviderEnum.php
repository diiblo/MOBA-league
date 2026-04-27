<?php

namespace App\Enum;

enum OAuthProviderEnum: string
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case DISCORD = 'discord';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::FACEBOOK => 'blue',
            self::GOOGLE => 'rose',
            self::DISCORD => 'indigo',
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
