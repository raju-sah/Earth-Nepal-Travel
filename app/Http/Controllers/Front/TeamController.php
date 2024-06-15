<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    public function team()
    {
        return view('front.pages.team', [
            'teams' => Team::select(['id', 'name', 'image', 'description', 'social_media'])->active()->latest()->get(),
        ]);
    }
}
