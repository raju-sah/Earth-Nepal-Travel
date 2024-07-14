<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Http\Requests\Api\ApiTeamRequest;
use App\Http\Requests\Api\PerPageRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamApiController extends Controller
{
    public function index(PerPageRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page');
        return TeamResource::collection(Team::active()->paginate($perPage));
    }
}
