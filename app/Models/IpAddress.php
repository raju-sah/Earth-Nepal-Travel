<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class IpAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ipAddressable(): MorphTo
    {
        return $this->morphTo();
    }
}
