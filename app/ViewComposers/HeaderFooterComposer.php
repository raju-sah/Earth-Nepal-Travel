<?php

namespace App\ViewComposers;

use App\Enums\PartnerType;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Partner;
use App\Models\SocialMediaSetting;
use Illuminate\View\View;

class HeaderFooterComposer
{
    protected mixed $site_setting;

    public function __construct()
    {
    }

    public function compose(View $view): void
    {
        $view->with([
            'destination_parent_menus' => Destination::active()->latest()->take(10)->pluck('title', 'slug'),
            'package_parent_menus' => Package::active()->latest()->take(10)->pluck('title', 'slug'),
            'socialMediaSettings' => SocialMediaSetting::select(['name', 'slug', 'social_link', 'social_icon'])->get(),
            'partners' => Partner::select(['name', 'link', 'image'])->where('type', PartnerType::Reviewer->value)->get(),
            'affiliateds' => Partner::select(['name', 'link', 'image'])->where('type', PartnerType::Affiliate->value)->get(),
        ]);
    }
}
