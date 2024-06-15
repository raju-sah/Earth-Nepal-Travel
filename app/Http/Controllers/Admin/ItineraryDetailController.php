<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ItineraryDurationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItineraryDetailRequest;
use App\Http\Requests\Admin\ItineraryDetailUpdateRequest;
use App\Models\Icon;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\Package;
use App\Traits\RowReOrderingTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItineraryDetailController extends Controller
{
    use RowReOrderingTrait;

    public function index(Package $package): JsonResponse
    {
        $itinerary_details =  ItineraryDetail::query()
            ->select(['id', 'icon', 'duration_value', 'duration_unit', 'order', 'itinerary_id'])
            ->where('package_id', $package->id)
            ->with('itinerary:id,day')
            ->orderBy('order')
            ->latest()->get();

        return response()->json(['itinerary_details' => $itinerary_details]);
    }

    public function create(Package $package): View
    {
        $package->load('itinerary_details');

        return view('admin.itinerary_detail.create', [
            'package' => $package,
            'icons' => Icon::select(['id', 'name', 'image'])->get(),
            'itineraries' => Itinerary::select(['id', 'day'])->where('package_id', $package->id)->orderBy('order')->get(),
            'duration_units' => ItineraryDurationType::cases(),
        ]);
    }

    public function store(ItineraryDetailRequest $request, Package $package): JsonResponse
    {
        $itinerary_detail = $package->itinerary_details()->create($request->validated());

        $itinerary_detail->load('itinerary:id,day');

        return response()->json(['detail_data' => $itinerary_detail, 'message' => 'Itinerary Detail created successfully.']);
    }


    public function show(ItineraryDetail $itinerary_detail): View
    {
        return view('admin.itinerary_detail.show', compact('itinerary_detail'));
    }

    public function edit(Package $package, ItineraryDetail $itinerary_detail): JsonResponse
    {
        return response()->json(['itinerary_detail' => $itinerary_detail, 'message' => 'Itinerary Detail Updated successfully.']);
    }

    public function update(ItineraryDetailUpdateRequest $request, Package $package, ItineraryDetail $itinerary_detail): JsonResponse
    {
        $itinerary_detail->update($request->validated());

        $updatedItineraryDetail = ItineraryDetail::find($itinerary_detail->id)->load('itinerary:id,day');

        return response()->json([
            'message' => 'Itinerary Detail Updated successfully.',
            'update_data' => $updatedItineraryDetail
        ]);
    }

    public function destroy(Package $package, ItineraryDetail $itinerary_detail): JsonResponse
    {
        $itinerary_detail->delete();

        return response()->json(['message' => 'Itinerary deleted successfully', 'deleted_data_id' => $itinerary_detail->id]);
    }

    public function bulkDelete(Request $request, Package $package): JsonResponse
    {
       ItineraryDetail::whereIn('id', $request->ajax_requested_ids)->where('package_id', $package->id)->delete();

        return response()->json([
            'data' => $request->ajax_requested_ids,
            'message' => 'Itineraries Details deleted successfully'
        ]);
    }

    public function rowReOrder(Package $package): void
    {
        $itinerary_details = ItineraryDetail::select(['id', 'order'])->where('package_id', $package->id)->get();

        $this->reOrder($itinerary_details);
    }
}
