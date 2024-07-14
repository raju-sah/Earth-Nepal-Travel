<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class IntroductionController extends Controller
{

    public function show(): View
    {
        return view('front.pages.introduction', [
            'page' => Page::select(['id', 'name', 'image',  'slug', 'description'])->where('slug', 'introduction')->first(),
        ]);
    }
}
