<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\SeasonPackageResource;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Services\ApiRelationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SeasonApiController extends Controller
{
    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        return SeasonResource::collection(Season::active()->paginate($perPage));
    }

    public function getPackages(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'type',
                'relation' => 'packages',
                'model' => Season::class,
                'resourceClass' => SeasonPackageResource::class,
                'fields' => 'title,slug,image',
            ],
        );
    }
}
