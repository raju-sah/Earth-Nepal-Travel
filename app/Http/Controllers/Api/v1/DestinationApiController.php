<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\DestinationActivityResource;
use App\Http\Resources\DestinationPackageResource;
use App\Http\Resources\DestinationPageResource;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use App\Services\ApiRelationService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class DestinationApiController extends Controller
{
    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        $query = Destination::active()
            ->orderByRaw('is_featured DESC');

        if ($request->input('is_featured') === 'Yes') {
            $query->where('is_featured', 1);
        } elseif ($request->input('is_featured') === 'No') {
            $query->where('is_featured', 0);
        }

        return DestinationResource::collection($query->paginate($perPage));
    }
    public function show($slug)
    {
        $destination = Destination::active()->where('slug', $slug)->with('activities:id,title,slug', 'packages:id,title,slug,image')->first();

        return new DestinationPageResource($destination);
    }

    public function getPackage(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'packages',
                'model' => Destination::class,
                'resourceClass' => DestinationPackageResource::class,
                'fields' => 'title,slug,image',
            ],
        );
    }
    public function getActivity(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'activities',
                'model' => Destination::class,
                'resourceClass' => DestinationActivityResource::class,
                'fields' => 'title,slug',
            ],
        );
    }
}
