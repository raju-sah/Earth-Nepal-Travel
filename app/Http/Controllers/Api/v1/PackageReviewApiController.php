<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageReviewStoreRequest;
use App\Models\PackageReview;

class PackageReviewApiController extends Controller
{
    public function store(PackageReviewStoreRequest $request)
    {
        $review = PackageReview::create($request->safe()->all());

        return response()->json($review, 201);
    }
}
