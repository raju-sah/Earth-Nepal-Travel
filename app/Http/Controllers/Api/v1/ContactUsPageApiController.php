<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsPageResource;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactUsPageApiController extends Controller
{
   public function index()

   {
      return new ContactUsPageResource(ContactUs::first());
   }
}
