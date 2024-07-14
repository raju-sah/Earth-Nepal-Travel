<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\DestinationCategoryDestinationResource;
use App\Http\Resources\DestinationCategoryResource;
use App\Models\DestinationCategory;
use App\Services\ApiRelationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestinationCategoryApiController extends Controller
{

    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        return DestinationCategoryResource::collection(DestinationCategory::active()->paginate($perPage));
    }

    public function getDestinations(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'destinations',
                'model' => DestinationCategory::class,
                'resourceClass' => DestinationCategoryDestinationResource::class,
                'fields' => 'title,slug',
            ],
        );
    }
}
