<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationCategoryRequest;
use App\Http\Requests\Admin\DestinationCategoryUpdateRequest;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Traits\DatatableTrait;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationCategoryController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        $this->authorize('access-destination-category-page');

        if ($request->ajax()) {
            $data = DestinationCategory::query()->select(['id', 'title', 'slug', 'status'])->latest();

            $config = [
                'additionalColumns' => [],
                'disabledButtons' => [],
                'model' => 'DestinationCategory',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => 'destination-categories',
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.destination_category.index', [
            'columns' => ['title', 'slug', 'status'],
        ]);
    }

    public function create(): View
    {
        $this->authorize('add-destination-category');

        return view('admin.destination_category.create');
    }

    public function store(DestinationCategoryRequest $request): RedirectResponse
    {
        $destinationCategory = DestinationCategory::create($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $destinationCategory->storeImage('image', 'destination-category-images', $request->file('image'));
        }

        return redirect()->route('admin.destination-categories.index')->with('success', 'Destination Category Created Successfully!');
    }

    public function show(DestinationCategory $destinationCategory): View
    {
        $this->authorize('access-destination-category-page');

        return view('admin.destination_category.show', compact('destinationCategory'));
    }

    public function edit(DestinationCategory $destinationCategory): View
    {
        $this->authorize('edit-destination-category');

        return view('admin.destination_category.edit', compact('destinationCategory'));
    }

    public function update(DestinationCategoryUpdateRequest $request, DestinationCategory $destinationCategory): RedirectResponse
    {
        $destinationCategory->update($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $destinationCategory->updateImage('image', 'destination-category-images', $request->file('image'));
        }

        return redirect()->route('admin.destination-categories.index')->with('success', 'Destination Category Updated Successfully!');
    }

    public function destroy(DestinationCategory $destinationCategory): RedirectResponse
    {
        $this->authorize('delete-destination-category');

        if ($destinationCategory->image) {
            $destinationCategory->deleteImage('image', 'destination-category-images');
        }

        if ($destinationCategory->destinations()->exists()) {
            return redirect()->back()->with('error', 'Destination Category Can Not Be Deleted Because It Contains Destinations!');
        }
        $destinationCategory->delete();

        return redirect()->back()->with('error', 'Destination Category Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('DestinationCategory', $request->id, $request->status);
    }
}
