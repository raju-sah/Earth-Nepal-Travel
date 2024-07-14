<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\OurService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurServiceRequest;
use App\Http\Requests\Admin\OurServiceUpdateRequest;

class OurServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.our_service.index', [
            'our_services' => OurService::query()->select(['id', 'page_title', 'banner_image', 'image', 'content_title', 'description'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $our_service = OurService::first();

        if (!is_null($our_service)) {
            return view('admin.our_service.edit', compact('our_service'));
        }

        return view('admin.our_service.create');
    }

    public function store(OurServiceRequest $request): RedirectResponse
    {
        $our_service = OurService::create($request->safe()->except('image', 'banner_image'));

        if ($request->hasFile('image')) {
            $our_service->storeImage('image', 'ourservice-images', $request->file('image'));
        }

        if ($request->hasFile('banner_image')) {
            $our_service->storeImage('banner_image', 'ourservice-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.our-services.create')->with('success', 'Our Service Created Successfully!');
    }

    public function show(OurService $our_service): View
    {
        return view('admin.our_service.show', compact('our_service'));
    }

    public function edit(OurService $our_service): View
    {
        return view('admin.our_service.edit', compact('our_service'));
    }

    public function update(OurServiceUpdateRequest $request, OurService $our_service): RedirectResponse
    {
        $our_service->update($request->safe()->except('image', 'banner_image'));

        if ($request->hasFile('image')) {
            $our_service->updateImage('image', 'ourservice-images', $request->file('image'));
        }

        if ($request->hasFile('banner_image')) {
            $our_service->updateImage('banner_image', 'ourservice-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.our-services.edit', $our_service)->with('success', 'Our Service Updated Successfully!');
    }

    public function destroy(OurService $our_service): RedirectResponse
    {
        if ($our_service->image) {
            $our_service->deleteImage('image', 'ourservice-images');
        }
        $our_service->delete();
        return redirect()->route('admin.our-services.index')->with('error', 'OurService Deleted Successfully!');
    }
}
