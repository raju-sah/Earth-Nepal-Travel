<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelDiaryPageResource;
use App\Models\TravelDiary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelDiaryPageApiController extends Controller
{



    public function index()
    {
        return new TravelDiaryPageResource(TravelDiary::with('images:id,image_name')->first());
    }
}
