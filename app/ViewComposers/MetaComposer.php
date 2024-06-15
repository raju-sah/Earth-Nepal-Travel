<?php

namespace App\ViewComposers;

use App\Models\SeoSetting;
use Illuminate\View\View;

class MetaComposer
{
    protected mixed $site_setting;

    public function __construct()
    {
    }

    public function compose(View $view): void
    {
        $view->with([
            'seoSettings' => SeoSetting::select(['name', 'meta_title', 'meta_keywords', 'meta_description'])->first(),
        ]);
    }
}
