<?php

namespace App\Providers;

use App\Models\Equipment;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\PackageFaq;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Observers\EquipmentObserver;
use App\Observers\FaqObserver;
use App\Observers\ItineraryDetailObserver;
use App\Observers\ItineraryObserver;
use App\Observers\PermissionObserver;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\ViewComposers\FooterComposer;
use App\ViewComposers\HeaderFooterComposer;
use App\ViewComposers\MetaComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //-------------------------------------------------------------------------VIEW-COMPOSERS
        View::composer("layouts.front_includes.footer", HeaderFooterComposer::class);
        View::composer("layouts.front_includes.header", HeaderFooterComposer::class);
        // View::composer("layouts._front_includes.meta", MetaComposer::class);

        //-------------------------------------------------------------------------OBSERVER
        Permission::observe(PermissionObserver::class);
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Itinerary::observe(ItineraryObserver::class);
        ItineraryDetail::observe(ItineraryDetailObserver::class);
        Equipment::observe(EquipmentObserver::class);
        PackageFaq::observe(FaqObserver::class);
    }
}
