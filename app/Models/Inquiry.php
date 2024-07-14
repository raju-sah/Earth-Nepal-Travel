<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DropdownStatusTrait;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Inquiry extends Model
{
    use HasFactory, DropdownStatusTrait;
    protected $guarded = [];

    public function inquiriable(): MorphTo
    {
        return $this->morphTo();
    }
}
