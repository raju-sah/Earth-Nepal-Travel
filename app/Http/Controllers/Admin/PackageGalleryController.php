<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageGalleryRequest;
use App\Http\Requests\Admin\PackageGalleryUpdateRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackageGalleryController extends Controller
{
    public function create(Package $package): View
    {
        $package->load('images');

        /* $hasGallery = $package->images()
             ->where(['imageable_type' => 'App\Models\Package', 'imageable_id' => $package->id])
             ->count();*/

        if (count($package->images) > 0) {
            return view('admin.package_gallery.edit-gallery', ['package' => $package]);
        }

        return view('admin.package_gallery.create-gallery', ['package' => $package]);
    }

    public function store(PackageGalleryRequest $request, Package $package): RedirectResponse
    {
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $package->storeMultiImage($image, 'package-gallery-images');
            }
        }

        return redirect()->route('admin.packages.package_faqs.create',$package->id)->with('success', 'Package Gallery Created Successfully!');
    }

    public function edit(Package $package)
    {
        $package->load('images');

        return view('admin.package_gallery.edit-gallery', ['package' => $package]);
    }

    public function update(PackageGalleryUpdateRequest $request, Package $package): RedirectResponse
    {
        if($request->has('images')) {
            foreach ($request->images as $image) {
                $package->storeMultiImage($image, 'package-gallery-images');
            }
        }

        return redirect()->route('admin.packages.package_faqs.create',$package->id)->with('success', 'Package Gallery Updated Successfully!');
    }
}
