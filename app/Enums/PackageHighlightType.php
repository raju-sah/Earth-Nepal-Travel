<?php

namespace App\Enums;

enum PackageHighlightType: string
{
    case Exclusive = 'Exclusive';
    case Trending = 'Trending';
    case MostViewed = 'Most Viewed';
    case None = 'None';
}
