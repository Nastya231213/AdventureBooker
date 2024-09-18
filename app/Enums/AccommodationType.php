<?php

namespace App\Enums;

enum AccommodationType: string
{
    case Hotel = 'hotel';
    case Apartment = 'apartment';
    case Hostel = 'hostel';
    case Resort = 'resort';
    public static function roomSupportedTypes(): array
    {
        return [
            self::Hotel->value,
            self::Hostel->value,
            self::Resort->value
        ];
    }
}