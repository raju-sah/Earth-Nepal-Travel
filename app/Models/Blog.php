<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory, UploadFileTrait, ModelQueryTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/blog-images/'.$this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
