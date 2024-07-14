<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\IndexSearchRequest;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function index(IndexSearchRequest $request): View
    {

        return view('front.index', [
            'testimonials' => Testimonial::query()->select(['id', 'name', 'email', 'rating',  'image', 'description'])->active()->latest()->take(5)->get(),
            'destinations' =>  Destination::pluck('title', 'slug'),
            'activities' => Activity::pluck('title', 'slug')


        ]);
    }


    public function search(IndexSearchRequest $request): View
    {
        return view('front.pages.packages.package_search', [
            'searchRequestDatas' => $request->safe()->all(),
        ]);
    }
}
