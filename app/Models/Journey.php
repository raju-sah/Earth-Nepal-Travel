<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UploadFileTrait;

class Journey extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $guarded = [];

    public function getImagePathAttribute(): string
    {
        return $this->img ? asset('uploaded-images/journey-images/' . $this->img) : "https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg";
    }
}
