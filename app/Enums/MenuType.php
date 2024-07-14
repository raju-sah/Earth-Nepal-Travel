<?php

namespace App\Enums;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\Package;
use App\Models\StaticPage;

enum MenuType: string
{
    case Default = 'Default';
    case Pages = StaticPage::class;
    case Custom = 'Custom';
    case Package = Package::class;
    case Activity = Activity::class;
    case Destination = Destination::class;
    case DestinationCategory = DestinationCategory::class;
}
