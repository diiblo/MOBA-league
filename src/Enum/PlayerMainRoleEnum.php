<?php

namespace App\Enum;

enum PlayerMainRoleEnum: string
{
    case TOP = 'top';
    case JUNGLE = 'jungle';
    case MID = 'mid';
    case ADC = 'adc';
    case SUPPORT = 'support';
    case FLEX = 'flex';
    case DUELIST = 'duelist';
    case CONTROLLER = 'controller';
    case INITIATOR = 'initiator';
    case SENTINEL = 'sentinel';
    case CARRY = 'carry';
    case OTHER = 'other';

    /** Couleur Tailwind associée */
    public function getColor(): string
    {
        return match ($this) {
            self::TOP => 'emerald',
            self::JUNGLE => 'green',
            self::MID => 'violet',
            self::ADC => 'rose',
            self::SUPPORT => 'cyan',
            self::FLEX => 'slate',
            self::DUELIST => 'red',
            self::CONTROLLER => 'indigo',
            self::INITIATOR => 'amber',
            self::SENTINEL => 'sky',
            self::CARRY => 'fuchsia',
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
