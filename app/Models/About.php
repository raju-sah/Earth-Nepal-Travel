<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;

class About extends Model
{
    use HasFactory, UploadFileTrait;

    protected $guarded = ['id'];

    public function getBannerPathAttribute(): string
    {
        return $this->banner_image ? asset('uploaded-images/about-images/'.$this->banner_image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/about-images/'.$this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
}
