<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;

class SocialMediaSetting extends Model
{
    use HasFactory, UploadFileTrait;
    protected $guarded = ['id'];
    public function getIconPathAttribute(): string
    {
        return $this->social_icon ? asset('uploaded-images/social-icon-images/'.$this->social_icon) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

}
