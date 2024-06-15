<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogApiController extends Controller
{
    // public function index(ApiBlogRequest $request): AnonymousResourceCollection
    // {
    //     $perPage = $request->input('per_page');
    //     $query = Blog::active()
    //         ->orderByRaw('is_popular DESC');

    //     if ($request->input('is_popular') === 'Yes') {
    //         $query->where('is_popular', 1);
    //     } elseif ($request->input('is_popular') === 'No') {
    //         $query->where('is_popular', 0);
    //     }
    //     return BlogResource::collection($query->paginate($perPage));
    // }

    // public function show($slug)
    // {
    //     $blog = Blog::active()->where('slug', $slug)->first();

    //     return new BlogResource($blog);
    // }
}
