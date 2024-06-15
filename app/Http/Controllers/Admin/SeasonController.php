<?php

namespace App\Http\Controllers\Admin;

use App\Traits\StatusTrait;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Season;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeasonRequest;
use App\Http\Requests\Admin\SeasonUpdateRequest;


class SeasonController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.season.index', [
            'seasons' => Season::query()->select(['id', 'type', 'starting_month', 'ending_month', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.season.create');
    }

    public function store(SeasonRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['title'] = $this->formattedMonth($data);

        Season::create($data);

        return redirect()->route('admin.seasons.index')->with('success', 'Season Created Successfully!');
    }

    public function show(Season $season): View
    {
        return view('admin.season.show', compact('season'));
    }

    public function edit(Season $season): View
    {
        return view('admin.season.edit', compact('season'));
    }

    public function update(SeasonUpdateRequest $request, Season $season): RedirectResponse
    {
        $data = $request->validated();

        if ($season->starting_month !== $data['starting_month'] || $season->ending_month !== $data['ending_month']) {
            $data['title'] = $this->formattedMonth($data);
        }

        $season->update($data);

        return redirect()->route('admin.seasons.index')->with('success', 'Season Updated Successfully!');
    }

    public function destroy(Season $season): RedirectResponse
    {
        if ($season->packages()->exists()) {
            return redirect()->back()->with('error', 'Season has packages. Please delete packages first.');
        }
        $season->delete();

        return redirect()->route('admin.seasons.index')->with('error', 'Season Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Season', $request->id, $request->status);
    }

    public function formattedMonth($data): string
    {
        $seasonInstance = new Season();

        return $data['type'] . ' (' . $seasonInstance->getFormattedMonth((int) $data['starting_month']) . ', ' . $seasonInstance->getFormattedMonth((int) $data['ending_month']) . ')';
    }
}
