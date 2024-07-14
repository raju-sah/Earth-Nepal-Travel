<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UploadFileTrait;

class Page extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/page-images/' . $this->image) : "https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg";
    }

    public function getBannerImagePathAttribute(): string
    {
        return $this->banner_image ? asset('uploaded-images/page-images/' . $this->banner_image) : "https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg";
    }
}
