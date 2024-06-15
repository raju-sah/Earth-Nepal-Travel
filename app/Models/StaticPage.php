<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class StaticPage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menu(): MorphOne
    {
        return $this->morphOne(Menu::class, 'menuable');
    }
}
