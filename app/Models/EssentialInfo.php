<?php

namespace App\Models;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EssentialInfo extends Model
{
    use HasFactory, UploadFileTrait;

    protected $guarded = ['id'];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/package-essential-info-images/'.$this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
