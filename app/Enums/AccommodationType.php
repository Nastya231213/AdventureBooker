<?php

namespace App\Enums;

enum AccommodationType: string
{
    case Hotel = 'hotel';
    case Apartment = 'apartment';
    case Hostel = 'hostel';
    case Resort = 'resort';
}