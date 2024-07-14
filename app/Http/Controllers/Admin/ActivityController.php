<?php

namespace App\Http\Controllers\Admin;

use App\Traits\DatatableTrait;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActivityRequest;
use App\Http\Requests\Admin\ActivityUpdateRequest;
use App\Traits\StatusTrait;

class ActivityController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        $this->authorize('access-activity-page');

        if ($request->ajax()) {
            $data = Activity::query()->select(['id', 'title', 'slug', 'is_exclusive', 'status'])->latest()->get();

            $config = [
                'additionalColumns' => [
                    'is_exclusive' => function ($row) {
                        return view('components.table.badge', ['value' => $row->is_exclusive,])->render();
                    },
                ],
                'disabledButtons' => [],
                'model' => 'Activity',
                'rawColumns' => ['is_exclusive', 'status', 'action'],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config);
        }

        return view('admin.activity.index', [
            'columns' => ['title', 'slug', 'is_exclusive', 'status'],
        ]);
    }

    public function create(): View
    {
        $this->authorize('add-activity');

        return view('admin.activity.create', [
            'activities_tree' => Activity::tree(),
        ]);
    }

    public function store(ActivityRequest $request): RedirectResponse
    {
        $activity = Activity::create($request->except('images'));

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $activity->storeMultiImage($image, 'activity-gallery-images', 100, 100);
            }
        }

        return redirect()->route('admin.activities.index')->with('success', 'Activity Created Successfully!');
    }

    public function show(Activity $activity): View
    {
        $this->authorize('access-activity-page');
        return view('admin.activity.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $this->authorize('edit-activity');

        $activity->load('parentActivity', 'images');

        return view('admin.activity.edit', [
            'activity' => $activity,
            'activities_tree' => Activity::tree(),
        ]);
    }

    public function update(ActivityUpdateRequest $request, Activity $activity): RedirectResponse
    {
        $activity->fill($request->safe()->except('images', 'is_parent'));

        if ($request->is_parent === "1") {
            $activity->parent_id = null;
        }

        $activity->save();

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $activity->storeMultiImage($image, 'activity-gallery-images', 100, 100);
            }
        }

        return redirect()->route('admin.activities.index')->with('success', 'Activity Updated Successfully!');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $this->authorize('delete-activity');

        foreach ($activity->images as $image) {
            @unlink('uploaded-images/activity-gallery-images/' . $image->image_name);
        }
        $activity->images()->delete();
        if ($activity->packages()->exists()) {
            return redirect()->back()->with('error', 'Activity has packages. Please delete packages first.');
        } elseif ($activity->destinations()->exists()) {
            return redirect()->back()->with('error', 'Activity has destinations. Please delete destinations first.');
        }
        $activity->delete();

        return redirect()->back()->with('error', 'Activity Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Activity', $request->id, $request->status);
    }
}
