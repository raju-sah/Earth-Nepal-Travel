<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaseMenu;
use Illuminate\Http\Request;

class BaseMenuController extends Controller
{
    public function index()
    {
        return view('admin.base_menu.index',[
            'base_menus' => BaseMenu::select(['id', 'title'])->active()->latest()->get()
        ]);
    }
}
