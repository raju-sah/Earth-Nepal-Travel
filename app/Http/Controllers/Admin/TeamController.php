<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Team;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Http\Requests\Admin\TeamUpdateRequest;
use App\Traits\StatusTrait;

class TeamController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.team.index', [
            'teams' => Team::query()->select(['id', 'name', 'designation', 'status'])->latest()->get()
        ]);
    }
    public function create(): View
    {
        return view('admin.team.create');
    }
    public function store(TeamRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image', 'social_link');
        $data['social_media'] = json_encode($request->social_link);
        $team = Team::create($data);

        if ($request->hasFile('image')) {
            $team->storeImage('image', 'team-images', $request->file('image'), 300, 300);
        }
        return redirect()->route('admin.teams.index')->with('success', 'Team Member Created Successfully!');
    }
    public function show(Team $team): View
    {
        return view('admin.team.show', compact('team'));
    }
    public function edit(Team $team): View
    {
        $data = [];
        if (!empty($team->social_media) && !is_null(json_decode($team->social_media))) {
            $data = json_decode($team->social_media, true);
        }
        return view('admin.team.edit', compact('team', 'data'));
    }
    public function update(TeamUpdateRequest $request, Team $team): RedirectResponse
    {
        $data = $request->safe()->except('image', 'social_name', 'social_link');
        $data['social_media'] = json_encode($request->social_link);
        $team->update($data);
        if ($request->hasFile('image')) {
            $team->updateImage('image', 'team-images', $request->file('image'), 120, 120);
        }
        return redirect()->route('admin.teams.index')->with('success', 'Team Member Updated Successfully!');
    }
    public function destroy(Team $team): RedirectResponse
    {
        if ($team->image) {
            $team->deleteImage('image', 'team-images');
        }
        $team->delete();
        return redirect()->route('admin.teams.index')->with('error', 'Team Member Deleted Successfully!');
    }
    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Team', $request->id, $request->status);
    }
}
