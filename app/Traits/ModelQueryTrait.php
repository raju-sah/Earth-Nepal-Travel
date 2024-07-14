<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ModelQueryTrait
{
    /**
     * @method static Builder active()
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '=', 1);
    }

    public function getFormattedStatusAttribute(): string
    {
        return $this->status === 1 ? 'Active' : 'Inactive';
    }
}
