<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipmentRequest;
use App\Http\Requests\Admin\EquipmentUpdateRequest;
use App\Http\Requests\Admin\ImportDestinationRequest;
use App\Http\Requests\Admin\ImportExcelRequest;
use App\Imports\EquipmentsImport;
use App\Models\Equipment;
use App\Models\Icon;
use App\Models\Package;
use App\Traits\RowReOrderingTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
{

    use RowReOrderingTrait;
    public function index(Package $package): JsonResponse
    {
        $equipment = Equipment::query()
            ->select(['id', 'title', 'icon', 'description', 'package_id', 'order'])
            ->where('package_id', $package->id)
            ->orderBy('order')
            ->get();

        return response()->json(['equipment' => $equipment]);
    }

    public function create(Package $package): View
    {
        $package->load('equipments');

        return view('admin.equipment.create', [
            'package' => $package,
            'icons' => Icon::select(['id', 'name', 'image'])->get()
        ]);
    }
    public function store(EquipmentRequest $request, Package $package): JsonResponse
    {
        $equipments = $package->equipments()->create($request->validated());

        return response()->json([
            'data' => $equipments,
            'message' => 'Equipment created successfully'
        ]);
    }

    public function show(Equipment $equipment): View
    {
        return view('admin.equipment.show', compact('equipment'));
    }

    public function edit(Package $package, Equipment $equipment): JsonResponse
    {
        return response()->json(['equipment' => $equipment]);
    }

    public function update(EquipmentUpdateRequest $request, Package $package, Equipment $equipment): JsonResponse
    {
        $equipment->update($request->validated());
        $equipments = Equipment::find($equipment->id);

        return response()->json([
            'update_data' => $equipments,
            'message' => 'Equipment updated successfully'

        ]);
    }

    public function destroy(Package $package, Equipment $equipment): JsonResponse
    {
        $equipment->delete();

        return response()->json([
            'message' => 'Equipment deleted successfully.',
            'delete_data_id' => $equipment->id
        ]);
    }

    public function bulkDelete(Request $request, Package $package): JsonResponse
    {
        Equipment::whereIn('id', $request->ajax_requested_ids)->where('package_id', $package->id)->delete(); 
        
        return response()->json([
            'message' => 'Equipment deleted successfully.',
            'data' => $request->ajax_requested_ids
        ]);
    }

    public function rowReOrder(Package $package): void
    {
        $equipment = Equipment::select(['id', 'order'])->where('package_id', $package->id)->get();
        $this->reOrder($equipment);
    }

    public function importExcel(ImportExcelRequest $request): RedirectResponse
    {
        try {

            Excel::import(new EquipmentsImport, $request->file('excel'));

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
