<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\About;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;
use App\Http\Requests\Admin\AboutUpdateRequest;
use App\Models\Icon;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('admin.about.index', [
            'abouts' => About::query()->select(['id', 'page_title', 'banner_image', 'image', 'content_title', 'description'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $icons = Icon::select(['id', 'name', 'image'])->get();
        $about = About::first();

        if (!is_null($about)) {
            return view('admin.about.edit', compact('about','icons'));  
        }

        return view('admin.about.create',[
            'icons' => Icon::select(['id', 'name', 'image'])->get()
        ]);
    }

    public function store(AboutRequest $request): RedirectResponse
    {
        $data = $request->except('image', 'banner_image','icon_title');

        $data['icon_title'] = json_encode([
            'icon' => $request->icon,
            'title' => $request->title
        ]);
        
        $about = About::create($data);

        if ($request->hasFile('image')) {
            $about->storeImage('image', 'about-images', $request->file('image'));
        }

        if ($request->hasFile('banner_image')) {
            $about->storeImage('banner_image', 'about-images', $request->file('banner_image'),1600,600);
        }

        return redirect()->route('admin.abouts.create')->with('success', 'About Created Successfully!');
    }

    public function show(About $about): View
    {
        return view('admin.about.show', compact('about'));
    }

    public function edit(About $about): View
    {
        return view('admin.about.edit',[
            'about' => $about,
            'icons' => Icon::select(['id', 'name', 'image'])->get()
        ]);
    }

    public function update(AboutUpdateRequest $request, About $about): RedirectResponse
    {

      $data =  $request->safe()->except('image', 'banner_image','icon','title');
        $data['icon_title'] = json_encode([
            'icon' => $request->icon,
            'title' => $request->title
        ]);

    //   dd($data);
        $about->update($data);

        if ($request->hasFile('image')) {
            $about->updateImage('image', 'about-images', $request->file('image'));
        }

        if ($request->hasFile('banner_image')) {
            $about->updateImage('banner_image', 'about-images', $request->file('banner_image'),1600,600);
        }

        return redirect()->route('admin.abouts.edit', $about)->with('success', 'About Updated Successfully!');
    }

    public function destroy(About $about): RedirectResponse
    {
        if ($about->image) {
            $about->deleteImage('image', 'about-images');
        }

        $about->delete();

        return redirect()->route('admin.abouts.index')->with('error', 'About Deleted Successfully!');
    }
}
