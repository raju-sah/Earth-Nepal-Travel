<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'additional_data' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->booking_id = 'bk'.'-'.random_int(1000, 9999).'-'.random_int(1000, 9999).'-'.random_int(100, 999);
        });
    }

    public function bookable(): MorphTo
    {
        return $this->morphTo();
    }

}
