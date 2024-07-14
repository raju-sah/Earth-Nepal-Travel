<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseMenu extends Model
{
    use HasFactory, ModelQueryTrait;

    protected $guarded = ['id'];

    protected $table = 'base_menus';

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
