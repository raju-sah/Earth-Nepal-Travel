<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        Cache::forget('user_permissions_'.auth()->id());
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        Cache::forget('user_permissions_'.auth()->id());
    }

}
