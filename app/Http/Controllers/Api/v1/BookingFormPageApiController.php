<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingFormPageResource;
use App\Models\BookingForm;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingFormPageApiController extends Controller
{
    public function index()
    {
        return new BookingFormPageResource(BookingForm::first());
    }
}
