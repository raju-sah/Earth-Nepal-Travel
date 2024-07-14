<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationRequest;
use App\Http\Requests\Admin\DestinationUpdateRequest;
use App\Http\Requests\Admin\ImportExcelRequest;
use App\Imports\DestinationsImport;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Traits\DatatableTrait;
use App\Traits\StatusTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class DestinationController extends Controller
{
    use StatusTrait, DatatableTrait;

   public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Destination::query()        // this is working because it has query() and other does not work because those doesnot have query()
            ->select(['id', 'title', 'slug', 'destination_category_id', 'status'])
            ->with('destinationCategory:id,title');

        $config = [
            'additionalColumns' => [
                'destination_category' => function ($row) {
                    return $row->destinationCategory->title;
                },
            ],
            'disabledButtons' => [],
            'model' => 'Destination',
            'rawColumns' => ['destination_category'],
            'sortable' => false,
            'routeClass' => null,
        ];

        return $this->getDataTable($request, $query, $config)->make(true);
    }

    return view('admin.destination.index', [
        'columns' => ['title', 'slug', 'destination_category', 'status'],
    ]);
}
    public function create()
    {
        $this->authorize('add-destination');

        return view('admin.destination.create', [
            'initialMarker' => [
                [
                    'position' => [
                        'lat' => 28.3780464,
                        'lng' => 83.9999901
                    ],
                    'draggable' => true
                ],
            ],
            'countries' => get_all_countries(),
            'destinationCategories' => DestinationCategory::query()->active()->pluck('title', 'id'),
            'activities' => Activity::select(['id', 'title'])->active()->pluck('title', 'id'),
            'destinations_tree' => Destination::tree(),
        ]);
    }

    public function store(DestinationRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $destination = Destination::create($request->safe()->except(['image', 'activities']));

            if ($request->hasFile('image')) {
                $destination->storeImage('image', 'destination-images', $request->file('image'), 600, 500);
            }

            $destination->activities()->attach($request->activities);

            DB::commit();
            return redirect()->route('admin.destinations.index')->with('success', 'Destination Created Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Destination $destination): View
    {
        $destination->load('activities');

        $this->authorize('access-destination-page');

        return view('admin.destination.show', [
            'destination' => $destination,
        ]);
    }

    public function edit(Destination $destination): View
    {
        $this->authorize('edit-destination');

        $destination->load(['parentDestination', 'activities']);

        return view('admin.destination.edit', [
            'initialMarker' => [
                [
                    'position' => [
                        'lat' => $destination->latitude,
                        'lng' => $destination->longitude
                    ],
                    'draggable' => true
                ],
            ],
            'destination' => $destination,
            'countries' => get_all_countries(),
            'destinationCategories' => DestinationCategory::query()->active()->pluck('title', 'id'),
            'activities' => Activity::select(['id', 'title'])->active()->get(),
            'destinations_tree' => Destination::tree(),
        ]);
    }

    public function update(DestinationUpdateRequest $request, Destination $destination): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $destination->fill($request->safe()->except(['image', 'is_parent', 'activities']));

            if ($request->is_parent == 1) {
                $destination->parent_id = null;
            }

            $destination->save();

            if ($request->hasFile('image')) {
                $destination->updateImage('image', 'destination-images', $request->file('image'), 600, 500);
            }

            $destination->activities()->sync($request->activities);

            DB::commit();
            return redirect()->route('admin.destinations.index')->with('success', 'Destination Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        $this->authorize('delete-destination');

        if ($destination->image) {
            $destination->deleteImage('image', 'destination-images');
        }

        if ($destination->packages()->exists()) {
            return redirect()->back()->with('error', 'Packages has destination. Please delete packages first.');
        }

        $destination->activities()->detach();
        $destination->delete();

        return redirect()->back()->with('error', 'Destination Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Destination', $request->id, $request->status);
    }
    public function importExcel(ImportExcelRequest $request): RedirectResponse
    {
        try {
            Excel::import(new DestinationsImport, $request->file('excel'));

            return back()->with('success', 'Imported Successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
            Session::push('failures', $e->failures());
            return back()->with('failures', $failures);
        } catch (\Exception $e) {
            return back()->with('error', "An Error occurred while importing excel: " . $e->getMessage());
        }
    }
}
