<?php

namespace App\Services;

use App\Enums\MenuType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuService
{
    /**
     * Prepare menu data for storing or updating.
     *
     * @param  Request  $request
     * @return array
     */
    public function prepareMenuData(Request $request): array
    {
        $data = $request->validated();
        $routeUrl = $request->url;

        if (!is_null($request->menuable_id) && $request->menuable_type !== MenuType::Custom->value) {
            $routeUrl = $this->resolveUrl($request->menu_type, $request->menuable_id, $routeUrl);
        }

        if (is_null($request->menuable_id) && $request->menu_type === MenuType::Default->value) {
            $routeUrl = '#';
        }

        $data['parent_id'] = $request->input('is_parent') === "1" ? null : $data['parent_id'];

        $data['menuable_type'] = !is_null($request->menuable_id) ? $request->menu_type : null;

        if (!is_null($data['menuable_type']) && in_array($data['menuable_type'], [MenuType::Default->value, MenuType::Custom->value], true)) {
            $data['menuable_id'] = null;
        }

        $data['url'] = $routeUrl;

        return $data;
    }

    /**
     *  Resolve the URL for a given menuable type and menuable ID.
     *
     * @param $menuableType
     * @param $menuableId
     * @param $routeUrl
     * @return string|null
     */
    protected function resolveUrl($menuableType, $menuableId, $routeUrl): ?string
    {
        if ($menuableType === MenuType::Default->value) {
            return '#';
        }

        if ($menuableType === MenuType::Custom->value) {
            return $routeUrl;
        }

        $model = $menuableType::findOrFail($menuableId);

        if ($menuableType === MenuType::Pages->value) {
            return $model->url;
        }

        // $routeName = 'front.' . $model->getTable() . '.show';
        // $routeUrl = route($routeName, $model->slug);

        // return "{{route('front.{$model->getTable()}.show', '{$model->slug}')}}";

        return Str::kebab(class_basename($model->getModel())).'/'.$model->slug;
    }
}
