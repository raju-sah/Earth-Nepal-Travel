<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurServicePageResource;
use App\Models\OurService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OurServicePageApiController extends Controller
{
    public function index()
    {
        return new OurServicePageResource(OurService::first()); 
       }
}
