<?php

namespace App\Enum;

enum CompetitionRuleKeyEnum: string
{
    case POINTS_WIN = 'points_win';
    case POINTS_DRAW = 'points_draw';
    case POINTS_LOSS = 'points_loss';
    case POINTS_FORFEIT_WIN = 'points_forfeit_win';
    case POINTS_FORFEIT_LOSS = 'points_forfeit_loss';
    case MAX_ROSTER_SIZE = 'max_roster_size';
    case MIN_ROSTER_SIZE = 'min_roster_size';
    case TIE_BREAKER_1 = 'tie_breaker_1';
    case TIE_BREAKER_2 = 'tie_breaker_2';
    case OTHER = 'other';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::POINTS_WIN => 'emerald',
            self::POINTS_DRAW => 'sky',
            self::POINTS_LOSS => 'rose',
            self::POINTS_FORFEIT_WIN => 'emerald',
            self::POINTS_FORFEIT_LOSS => 'rose',
            self::MAX_ROSTER_SIZE => 'violet',
            self::MIN_ROSTER_SIZE => 'cyan',
            self::TIE_BREAKER_1 => 'amber',
            self::TIE_BREAKER_2 => 'orange',
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
