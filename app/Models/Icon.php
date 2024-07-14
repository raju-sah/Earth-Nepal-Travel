<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;

class Icon extends Model
{
    use HasFactory, UploadFileTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/icon-images/'.$this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
}
