<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        Cache::forget('permissions_slugs');
        Cache::forget('user_permissions_'.auth()->id());
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        Cache::forget('permissions_slugs');
        Cache::forget('user_permissions_'.auth()->id());
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        Cache::forget('permissions_slugs');
        Cache::forget('user_permissions_'.auth()->id());
    }
}
