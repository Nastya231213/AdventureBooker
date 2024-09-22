<?php

namespace App\Enums;

enum RoomType: string
{
    case Single = 'Single';
    case Double = 'Double';
    case Suite = 'Suite';
    case Deluxe = 'Deluxe';
    static public function getValues()
    {
        return array_map(
            function ($case) {
                return $case->value;
            },
            self::cases()
        );
    }
}
