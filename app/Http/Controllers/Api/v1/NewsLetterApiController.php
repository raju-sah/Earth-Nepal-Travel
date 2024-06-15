<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsLetterRequest;
use App\Models\NewsLetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsLetterApiController extends Controller
{
    public function store(NewsLetterRequest $request): JsonResponse
    {
        $newsletter = NewsLetter::create($request->validated());
        return response()->json($newsletter, 201);
    }
}
