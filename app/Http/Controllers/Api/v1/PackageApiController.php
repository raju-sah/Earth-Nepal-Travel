<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiPackageRequest;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\PackageActivityResource;
use App\Http\Resources\PackageDestinationResource;
use App\Http\Resources\PackagePageResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageSeasonResource;
use App\Http\Resources\PackageServiceResource;
use App\Models\Package;
use App\Services\ApiRelation;
use App\Services\ApiRelationService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PackageApiController extends Controller
{
    public function index(ApiPackageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        $packageQuery = Package::active();

        if ($request->has('type')) {
            $packageQuery->where('journey_type', $request->type);
        }

        $packages = $packageQuery->paginate($perPage);

        return PackageResource::collection($packages);
    }

    public function show($slug)
    {
        $package = Package::active()->where('slug', $slug)->with(
            'images',
            'itineraries:id,title,day,icon,description,meals,max_altitude,accommodation,transportation,package_id',
            'essential_info:id,info,image,package_id',
            'equipments:id,title,icon,package_id',
            'include_exclude:id,includes,excludes,package_id',
            'common_faqs:id,question,answer',
            'package_faqs:id,question,answer,package_id',
        )->first();
        return new PackagePageResource($package);
    }

    public function getActivity(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'activities',
                'model' => Package::class,
                'resourceClass' => PackageActivityResource::class,
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
                'model' => Package::class,
                'resourceClass' => PackageDestinationResource::class,
                'fields' => 'title,slug,image',
            ],
        );
    }
    public function getService(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'services',
                'model' => Package::class,
                'resourceClass' => PackageServiceResource::class,
                'fields' => 'title,slug,image',
            ],
        );
    }

    public function getSeason(PerPageRequest $request, $slug, ApiRelationService $ApiRelation)
    {
        return $ApiRelation->getApiRelationData(
            $request,
            $slug,
            [
                'column' => 'slug',
                'relation' => 'seasons',
                'model' => Package::class,
                'resourceClass' => PackageSeasonResource::class,
                'fields' => 'title,type,starting_month,ending_month,status',
            ],
        );
    }
}
