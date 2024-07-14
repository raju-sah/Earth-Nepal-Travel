<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Requests\Api\ApiMenuRequest;
use App\Http\Resources\FooterMenuResource;
use App\Http\Resources\TopMenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MenuApiController extends Controller
{
    public function getTopMenu(): AnonymousResourceCollection
    {
        return TopMenuResource::collection(Menu::tree(1)->all());
    }

    public function getFooterMenu(): AnonymousResourceCollection
    {
        return FooterMenuResource::collection(Menu::tree(2)->all());
    }

}
