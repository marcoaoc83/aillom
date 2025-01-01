<?php

namespace App\Enums;

enum EntityType: string
{
    case PJ = 'PJ';
    case PF = 'PF';

    public static function values(): array
    {
        return [
            self::PJ->value,
            self::PF->value,
        ];
    }

    // Retorna um array associativo com valor como chave e label como valor
    public static function toArray(): array
    {
        return [
            self::PJ->value => 'Pessoa Jurídica',
            self::PF->value => 'Pessoa Física',
        ];
    }
}
