<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\Season;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportExcelRequest;
use App\Http\Requests\Admin\PackageImportRequest;
use App\Http\Requests\Admin\PackageRequest;
use App\Http\Requests\Admin\PackageUpdateRequest;
use App\Imports\PackageImport;
use App\Models\Journey;
use App\Traits\DatatableTrait;
use App\Traits\StatusTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class PackageController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Package::query()->select(['id', 'title', 'slug', 'journey_type', 'status'])->latest();   // this is working because it has query() and other does not work because those doesnot have query()

            if ($request->get('package_type')) {
                $query->where('journey_type', $request->package_type);
            }

            $config = [
                'additionalColumns' => [
                    'journey_type' => function ($row) {
                        $journeyType = $row->journey_type ? $row->journey_type : 'N/A';
                        $badgeClass = $row->journey_type ? 'bg-info' : 'bg-danger';
                        return new HtmlString('<span class="badge ' . $badgeClass . '">' . $journeyType . '</span>');
                    },
                ],

                'disabledButtons' => [],
                'model' => 'Package',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $query, $config)->make(true);
        }

        return view('admin.package.index', [
            'columns' => ['id', 'title', 'slug', 'journey_type', 'status'],
        ]);
    }

    public function create(): View
    {
        return view('admin.package.create', [
            'seasons' => Season::select(['id', 'title'])->active()->pluck('title', 'id'),
            'services' => Service::select(['id', 'title'])->active()->pluck('title', 'id'),
            'journies' => Journey::select(['id', 'name'])->where('status', 1)->pluck('name', 'id'),
            'activities' => $this->resolveActivities(),
            'destinations' => $this->resolveDestinations(),
        ]);
    }

    public function store(PackageRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $data = $request->safe()->except('road_map', 'image', 'seasons', 'activities', 'destinations', 'services', 'journey_type_childs');

            if ($request->has('journey_type_childs')) {
                $data['journey_type_childs'] = json_encode($request->journey_type_childs);
            }
            $package = auth()->user()->packages()->create($data);

            if ($request->hasFile('image')) {
                $package->storeImage('image', 'package-banner-images', $request->file('image'),600,500);
            }

            if ($request->hasFile('road_map')) {
                $package->storeImage('road_map', 'package-road-map-images', $request->file('road_map'));
            }

            $package->seasons()->attach($request->seasons);
            $package->activities()->attach($request->activities);
            $package->destinations()->attach($request->destinations);
            $package->services()->attach($request->services);

            DB::commit();
            return redirect()->route('admin.packages.itineraries.create', $package->id)->with('success', 'Package Created Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function show(Package $package): View
    {
        $journey_type_childs = json_decode($package->journey_type_childs, true);

        // Ensure journey_type_childs is an array
        if (!is_array($journey_type_childs)) {
            $journey_type_childs = [];
        }
        $journey_type_childs_names = Journey::where('status', 1)
            ->whereIn('id', $journey_type_childs)
            ->pluck('name');

        return view('admin.package.show', compact('package', 'journey_type_childs_names'));
    }

    public function edit(Package $package): View
    {
        $package->load(['seasons', 'images', 'activities']);

        $journey_type_childs = json_decode($package->journey_type_childs);

        return view('admin.package.edit', [
            'package' => $package,
            'activities' => $this->resolveActivities(),
            'destinations' => $this->resolveDestinations(),
            'seasons' => Season::select(['id', 'title'])->active()->get(),
            'services' => Service::select(['id', 'title'])->active()->get(),
            'journies' => Journey::select(['id', 'name'])->where('status', 1)->pluck('name', 'id'),
            'journey_type_childs' => $journey_type_childs

        ]);
    }

    public function update(PackageUpdateRequest $request, Package $package): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->safe()->except('road_map', 'image', 'seasons', 'activities', 'destinations', 'services', 'journey_type_childs');
            $data['journey_type_childs'] = json_encode($request->journey_type_childs);
            $package->update($data);

            if ($request->hasFile('image')) {
                $package->updateImage('image', 'package-banner-images', $request->file('image'),600,500);
            }

            if ($request->hasFile('road_map')) {
                $package->updateImage('road_map', 'package-road-map-images', $request->file('road_map'));
            }

            $package->seasons()->sync($request->seasons);
            $package->activities()->sync($request->activities);
            $package->destinations()->sync($request->destinations);
            $package->services()->sync($request->services);

            DB::commit();
            return redirect()->route('admin.packages.itineraries.create', $package->id)->with('success', 'Package Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Package $package): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $package->seasons()->detach();
            $package->activities()->detach();
            $package->destinations()->detach();
            $package->common_faqs()->detach();

            if ($package->image) {
                $package->deleteImage('image', 'package-banner-images');
            }

            if ($package->road_map) {
                $package->deleteImage('road_map', 'package-road-map-images');
            }

            $package->delete();

            foreach ($package->images as $img) {
                @unlink('uploaded-images/package-gallery-images/' . $img->image_name);
            }

            $package->images()->delete();

            DB::commit();
            return redirect()->route('admin.packages.index')->with('error', 'Package Deleted Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Package', $request->id, $request->status);
    }

    public function resolveActivities()
    {
        return Activity::select(['id', 'parent_id', 'title'])
            ->with(['parentActivity', 'childActivities:id,parent_id,title', 'childActivities.childActivities:id,parent_id,title'])
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereHas('parentActivity', function ($query) {
                    $query->select(['id', 'parent_id', 'title'])->where('status', 1);
                })
                    ->orWhere('status', 1);
            })
            ->with(['parentActivity' => function ($query) {
                $query->select(['id', 'parent_id', 'title'])->where('status', 1)
                    ->with(['parentActivity' => function ($query) {
                        $query->select(['id', 'parent_id', 'title'])->where('status', 1);
                    }]);
            }])
            ->get();
    }

    public function resolveDestinations()
    {
        return Destination::select(['id', 'parent_id', 'title'])
            ->with(['parentDestination', 'childDestinations:id,parent_id,title', 'childDestinations.childDestinations:id,parent_id,title'])
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereHas('parentDestination', function ($query) {
                    $query->select(['id', 'parent_id', 'title'])->where('status', 1);
                })
                    ->orWhere('status', 1);
            })
            ->with(['parentDestination' => function ($query) {
                $query->select(['id', 'parent_id', 'title'])->where('status', 1)
                    ->with(['parentDestination' => function ($query) {
                        $query->select(['id', 'parent_id', 'title'])->where('status', 1);
                    }]);
            }])
            ->get();
    }

    public function importExcel(ImportExcelRequest $request): RedirectResponse
    {
        try {

            Excel::import(new PackageImport, $request->file('excel'));

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

    public function dependentJourniesCreate($type)
    {
        $childs = Journey::where('status', 1)->where('type', $type)->pluck('name', 'id');
        return response()->json($childs);
    }
    public function dependentJourniesEdit($package, $type)
    {
        $childs = Journey::where('type', $type)->where('status', 1)->pluck('name', 'id');
        return response()->json($childs);
    }
}
