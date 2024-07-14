<?php

namespace App\Enums;

enum DateFilterType: string
{
    case Day = 'Day';
    case Week = 'Week';
    case Month = 'Month';
    case SixMonths = 'Six Months';
    case Year = 'Year';
}
