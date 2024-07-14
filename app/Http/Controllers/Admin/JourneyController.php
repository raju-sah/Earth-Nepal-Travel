<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Journey;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JourneyStoreRequest;
use App\Http\Requests\Admin\JourneyUpdateRequest;
use App\Traits\StatusTrait;

class JourneyController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.journey.index', [
            'journeys' => Journey::query()->select(['id', 'name', 'slug',  'type', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.journey.create');
    }

    public function store(JourneyStoreRequest $request): RedirectResponse
    {
        $journey = Journey::create($request->safe()->except('img'));
        if ($request->hasFile('img')) {
            $journey->storeImage('img', 'journey-images', $request->file('img'));
        }

        return redirect()->route('admin.journeys.index')->with('success', 'Journey Created Successfully!');
    }

    public function show(Journey $journey): View
    {
        return view('admin.journey.show', compact('journey'));
    }

    public function edit(Journey $journey): View
    {
        return view('admin.journey.edit', compact('journey'));
    }

    public function update(JourneyUpdateRequest $request, Journey $journey): RedirectResponse
    {
        $data = $request->safe()->except('img');
        if ((bool) $request->input('journey_removed') === true) {
            $journey->deleteImage('img', 'journey-images');
            $data['img'] = null;
        }

        $journey->update($data);

        if ($request->hasFile('img')) {
            $journey->updateImage('img', 'journey-images', $request->file('img'));
        }

        return redirect()->route('admin.journeys.index')->with('success', 'Journey Updated Successfully!');
    }

    public function destroy(Journey $journey): RedirectResponse
    {
        if ($journey->img) {
            $journey->deleteImage('img', 'journey-images');
        }

        $journey->delete();

        return redirect()->route('admin.journeys.index')->with('error', 'Journey Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Journey', $request->id, $request->status);
    }
}
