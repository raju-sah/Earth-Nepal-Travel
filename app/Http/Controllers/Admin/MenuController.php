<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MenuType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Requests\Admin\MenuUpdateRequest;
use App\Models\BaseMenu;
use App\Models\Menu;
use App\Models\StaticPage;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(BaseMenu $base_menu): View
    {
        return view('admin.menu.index', [
            'base_menu' => $base_menu,
            'menus' => Menu::tree($base_menu->id),
            'menus_list' => Menu::query()->select(['id', 'title', 'order', 'parent_id'])
                ->whereBaseMenuId($base_menu->id)
                ->orderByRaw("COALESCE(parent_id, ''), parent_id ASC")
                ->orderBy('order')
                ->oldest()
                ->get()
        ]);
    }

    public function create(BaseMenu $base_menu): View
    {
        return view('admin.menu.create', [
            'menu_tree' => Menu::tree($base_menu->id),
            'base_menu' => $base_menu
        ]);
    }

    public function store(MenuRequest $request, BaseMenu $base_menu, MenuService $menuService): RedirectResponse
    {
        $menuData = $menuService->prepareMenuData($request);

        $menu = new Menu($menuData);
        $menu->base_menu_id = $base_menu->id;
        $menu->save();

        return redirect()->route('admin.base-menus.menus.index', $base_menu)->with('success', 'Menu Created Successfully!');
    }

    public function show(Menu $menu): View
    {
        return view('admin.menu.show', compact('menu'));
    }

    public function edit(BaseMenu $base_menu, Menu $menu): View
    {
        return view('admin.menu.edit', [
            'menu' => $menu,
            'menu_tree' => Menu::tree($base_menu->id, $menu->id),
            'base_menu' => $base_menu
        ]);
    }

    public function update(MenuUpdateRequest $request, BaseMenu $base_menu, Menu $menu, MenuService $menuService): RedirectResponse
    {
        $menuData = $menuService->prepareMenuData($request);

        $menu->update($menuData);

        return redirect()->route('admin.base-menus.menus.index', $base_menu)->with('success', 'Menu Updated Successfully!');
    }

    public function destroy(BaseMenu $base_menu, Menu $menu): RedirectResponse
    {
        $menu->delete();

        return redirect()->route('admin.base-menus.menus.index', $base_menu)->with('error', 'Menu Deleted Successfully!');
    }

    public function getDataByModel(Request $request): JsonResponse
    {
        if ($request->modelName === MenuType::Pages->value) {
            return response()->json(['data' => StaticPage::select(['id as _id', 'title', 'url'])->get()]);
        }

        $model = $request->modelName;

        return response()->json(['data' => $model::query()->select(['id as _id', 'title', 'slug'])->get()]);
    }
}
