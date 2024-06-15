<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialApiRequest;
use App\Models\Testimonial;

class TestimonialApiController extends Controller
{

    public function store(TestimonialApiRequest $request)
    {
        $testimonial = Testimonial::create($request->validated());
        if ($request->hasFile('image')) {
            $testimonial->storeImage('image', 'testimonial-images', $request->file('image'));
        }
        return response()->json($testimonial, 201);
    }
}
