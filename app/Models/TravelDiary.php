<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TravelDiary extends Model
{
    use HasFactory, UploadFileTrait;

    protected $guarded = ['id'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
