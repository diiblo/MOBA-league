<?php

namespace App\Enum;

enum SeasonStatusEnum: string
{
    case DRAFT = 'draft';
    case RUNNING = 'running';
    case FINISHED = 'finished';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::DRAFT => 'slate',
            self::RUNNING => 'emerald',
            self::FINISHED => 'zinc',
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
