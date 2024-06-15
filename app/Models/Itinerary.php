<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Itinerary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function itinerary_details(): HasMany
    {
        return $this->hasMany(ItineraryDetail::class);
    }
}
