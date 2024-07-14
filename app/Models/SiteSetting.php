<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SettingUploadFileTrait;

class SiteSetting extends Model
{
    use HasFactory, SettingUploadFileTrait;
    protected $guarded = [];
    public function getLogoPathAttribute(): string
    {
        return $this->logo ? asset('uploaded-images/site-setting-images/'.$this->logo) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }   //end of method
    public function getFaviconPathAttribute(): string
    {
        return $this->favicon ? asset('uploaded-images/site-setting-images/'.$this->favicon) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }   //end of method
}
