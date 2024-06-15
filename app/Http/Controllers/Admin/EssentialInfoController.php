<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EssentialInfoRequest;
use App\Http\Requests\Admin\EssentialInfoUpdateRequest;
use App\Models\EssentialInfo;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EssentialInfoController extends Controller
{
    public function index(Package $package): View
    {
        return view('admin.essential_info.index', [
            'essential_infos' => EssentialInfo::query()->select(['id', 'info', 'package_id'])->latest()->get()
        ]);
    }

    public function create(Package $package): View
    {
        if ($package->essential_info()->count() > 0) {
            $essentialInfo = $package->essential_info;

            return view('admin.essential_info.edit', [
                'package' => $package,
                'essential_info' => $essentialInfo
            ]);
        }

        return view('admin.essential_info.create',['package' => $package]);
    }

    public function store(EssentialInfoRequest $request, Package $package): RedirectResponse
    {
        $essential_info = $package->essential_info()->create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $essential_info->storeImage('image', 'package-essential-info-images', $request->file('image'));
        }

        return redirect()->route('admin.packages.equipment.create',$package->id)->with('success', 'Essential Info Created Successfully!');
    }

    public function show(EssentialInfo $essential_info, Package $package): View
    {
        return view('admin.essential_info.show', compact('essential_info'));
    }

    public function edit(Package $package, EssentialInfo $essential_info): View
    {
        return view('admin.essential_info.edit', [
            'package' => $package,
            'essential_info' => $essential_info,
        ]);
    }

    public function update(EssentialInfoUpdateRequest $request, Package $package, EssentialInfo $essential_info): RedirectResponse
    {
        $essential_info->update($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $essential_info->updateImage('image', 'package-essential-info-images', $request->file('image'));
        }

        return redirect()->route('admin.packages.equipment.create',$package->id)->with('success', 'Essential Info Updated Successfully!');
    }

    public function destroy(Package $package, EssentialInfo $essential_info): JsonResponse
    {
        if($essential_info->image) {
            $essential_info->deleteImage('image', 'package-essential-info-images');
        }

        $essential_info->delete();

        return response()->json(true);
    }
}
