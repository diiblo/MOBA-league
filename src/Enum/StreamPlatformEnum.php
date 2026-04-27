<?php

namespace App\Enum;

enum StreamPlatformEnum: string
{
    case TWITCH = 'twitch';
    case YOUTUBE = 'youtube';
    case FACEBOOK = 'facebook';
    case KICK = 'kick';
    case OTHER = 'other';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::TWITCH => 'violet',
            self::YOUTUBE => 'rose',
            self::FACEBOOK => 'blue',
            self::KICK => 'emerald',
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
