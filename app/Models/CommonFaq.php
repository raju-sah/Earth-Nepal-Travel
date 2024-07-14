<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CommonFaq extends Model
{
    use HasFactory, ModelQueryTrait;

    protected $guarded = ['id'];

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'common_faq_package', 'common_faq_id', 'package_id');
    }
}
