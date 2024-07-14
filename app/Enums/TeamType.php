<?php

namespace App\Enums;

enum TeamType: string
{
    case CEO = 'CEO';
    case Manager = 'Manager';
    case TourGuide = 'Tour Guide';
    case TrekkingGuide = 'Trekking Guide';
    case Potter = 'Potter';
}
