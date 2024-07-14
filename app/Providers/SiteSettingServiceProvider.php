<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ViewComposers\SiteSettingComposer;

class SiteSettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SiteSettingComposer::class);
    }

    public function boot(): void
    {
        view()->composer(['*'], SiteSettingComposer::class);
    }
}
