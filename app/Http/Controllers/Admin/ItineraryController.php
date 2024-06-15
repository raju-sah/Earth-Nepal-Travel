<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportExcelRequest;
use App\Http\Requests\Admin\ItineraryRequest;
use App\Http\Requests\Admin\ItineraryUpdateRequest;
use App\Imports\ItineraryImport;
use App\Models\Icon;
use App\Models\Itinerary;
use App\Models\Package;
use App\Traits\RowReOrderingTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ItineraryController extends Controller
{
    use RowReOrderingTrait;

    public function index(Package $package): JsonResponse
    {
        $itineraries = Itinerary::query()
            ->select(['id', 'title', 'day', 'icon', 'package_id', 'order'])
            ->where('package_id', $package->id)
            ->orderBy('order')
            ->get();

        return response()->json(['itineraries' => $itineraries]);
    }

    public function create(Package $package): View
    {
        $package->load('itineraries');

        return view('admin.itinerary.create', [
            'package' => $package,
            'icons' => Icon::select(['id', 'name', 'image'])->get()
        ]);
    }

    public function store(ItineraryRequest $request, Package $package): JsonResponse
    {
        $itinerary = $package->itineraries()->create($request->validated());

        return response()->json(['data' => $itinerary, 'message' => 'Itinerary created successfully']);
    }

    public function show(Itinerary $itinerary): View
    {
        return view('admin.itinerary.show', compact('itinerary'));
    }

    public function edit(Package $package, Itinerary $itinerary): JsonResponse
    {
        return response()->json(['itinerary' => $itinerary]);
    }

    public function update(ItineraryUpdateRequest $request, Package $package, Itinerary $itinerary): JsonResponse
    {
        $itinerary->update($request->validated());
        $updatedItinerary = Itinerary::find($itinerary->id);

        return response()->json(['update_data' => $updatedItinerary, 'message' => 'Itinerary updated successfully']);
    }


    public function destroy(Package $package, Itinerary $itinerary): JsonResponse
    {
        $itinerary->delete();
        return response()->json(['message' => 'Itinerary deleted successfully', 'deleted_data_id' => $itinerary->id]);
    }

    public function bulkDelete(Request $request, Package $package): JsonResponse
    {
       Itinerary::whereIn('id', $request->ajax_requested_ids) ->where('package_id', $package->id) ->delete();
       
        return response()->json([
            'data' => $request->ajax_requested_ids,
            'message' => 'Itineraries deleted successfully'
        ]);
    }

    public function rowReOrder(Package $package): void
    {
        $itineraries = Itinerary::select(['id', 'order'])->where('package_id', $package->id)->get();
        $this->reOrder($itineraries);
    }

    public function importExcel(ImportExcelRequest $request): RedirectResponse
    {
        try {

            Excel::import(new ItineraryImport, $request->file('excel'));

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
