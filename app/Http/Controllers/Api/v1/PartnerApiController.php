<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PartnerApiController extends Controller
{
    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        return PartnerResource::collection(Partner::where('status', 1)->paginate($perPage));
    }
}
