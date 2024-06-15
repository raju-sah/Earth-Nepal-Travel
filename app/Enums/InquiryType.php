<?php

namespace App\Enums;

enum InquiryType: string
{
    case Contact = 'Contact';
    case Package = 'Package';
    case Destination = 'Destination';
    case Activity = 'Activity';
}
