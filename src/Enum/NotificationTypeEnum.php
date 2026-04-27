<?php

namespace App\Enum;

enum NotificationTypeEnum: string
{
    case MATCH_SCHEDULED = 'match_scheduled';
    case REGISTRATION_APPROVED = 'registration_approved';
    case REGISTRATION_REJECTED = 'registration_rejected';
    case MATCH_RESULT = 'match_result';
    case DISPUTE_OPENED = 'dispute_opened';
    case DISPUTE_RESOLVED = 'dispute_resolved';
    case QUALIFICATION_EARNED = 'qualification_earned';
    case OTHER = 'other';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::MATCH_SCHEDULED => 'sky',
            self::REGISTRATION_APPROVED => 'emerald',
            self::REGISTRATION_REJECTED => 'rose',
            self::MATCH_RESULT => 'indigo',
            self::DISPUTE_OPENED => 'amber',
            self::DISPUTE_RESOLVED => 'emerald',
            self::QUALIFICATION_EARNED => 'violet',
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
