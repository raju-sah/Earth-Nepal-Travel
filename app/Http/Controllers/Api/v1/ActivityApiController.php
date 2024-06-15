<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiActivityRequest;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\ActivityDestinationResource;
use App\Http\Resources\ActivityPackageResource;
use App\Http\Resources\ActivityPageResource;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Services\ApiRelationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityApiController extends Controller
{
    public function index(ApiActivityRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        $query = Activity::active()
            ->orderByRaw('is_exclusive DESC')
            ->with('destinations:id,title,slug,image', 'images:id,image_name');


        if ($request->input('is_exclusive') === 'Yes') {
            $query->where('is_exclusive', 1);
        } elseif ($request->input('is_exclusive') === 'No') {
            $query->where('is_exclusive', 0); // Only include non-exclusive activities
        }
        return ActivityResource::collection($query->paginate($perPage));
    }
    public function show($slug)
    {
        $activity = Activity::active()->where('slug', $slug)->with('destinations:id,title,slug,image', 'images', 'packages:id,title,slug,image')->first();
        return response()->json(new ActivityPageResource($activity), 200);
    }

    public function getPackage(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'packages',
                'model' => Activity::class,
                'resourceClass' => ActivityPackageResource::class,
                'fields' => 'title,slug',
            ],
        );
    }
    public function getDestination(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'destinations',
                'model' => Activity::class,
                'resourceClass' => ActivityDestinationResource::class,
                'fields' => 'title,slug,image',
            ],
        );
    }
}
