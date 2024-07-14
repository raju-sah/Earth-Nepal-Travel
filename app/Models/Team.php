<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UploadFileTrait;

class Team extends Model
{
    use HasFactory, UploadFileTrait, ModelQueryTrait;

    protected $guarded = ['id'];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/team-images/'.$this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
}
