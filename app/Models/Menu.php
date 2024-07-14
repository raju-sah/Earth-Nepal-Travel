<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menuable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parentMenu(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function childMenus(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function base_menu(): BelongsTo
    {
        return $this->belongsTo(BaseMenu::class);
    }

    public static function tree($baseMenuId, $menuId = null)
    {
        $allMenusQuery = self::select(['id', 'title', 'parent_id', 'url', 'is_clickable', 'target'])->orderBy('order')->whereBaseMenuId($baseMenuId);

        if ($menuId) {
            $allMenusQuery->where('id', '!=', $menuId);
        }

        $allMenus = $allMenusQuery->get();

        $rootMenus = $allMenus->whereNull('parent_id');

        self::formatTree($rootMenus, $allMenus);

        return $rootMenus;
    }

    private static function formatTree($menus, $allMenus): void
    {
        foreach ($menus as $menu) {
            $menu->children = $allMenus->where('parent_id', $menu->id)->values();

            if ($menu->children->isNotEmpty()) {
                self::formatTree($menu->children, $allMenus);
            }
        }
    }
}
