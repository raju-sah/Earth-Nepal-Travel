<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageReview extends Model
{
    use HasFactory, ModelQueryTrait;

    protected $guarded = ['id'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
