<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\ServicePackageResource;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ApiRelationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceApiController extends Controller
{
    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        return ServiceResource::collection(Service::active()->paginate($perPage));
    }

    public function getPackages(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'packages',
                'model' => Service::class,
                'resourceClass' => ServicePackageResource::class,
                'fields' => 'title,slug,image',
            ],
        );             
    }
}
