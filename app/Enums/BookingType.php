<?php

namespace App\Enums;

enum BookingType: string
{
    case Package = 'Package';
    case Hotel = 'Hotel';
    case Flight = 'Flight';
}
