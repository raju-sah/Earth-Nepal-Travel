<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;

class InquiryFormApiController extends Controller
{
    public function store(InquiryRequest $request): JsonResponse
    {
        $inquiry = Inquiry::create($request->validated());
        return response()->json($inquiry, 201);
    }
}
