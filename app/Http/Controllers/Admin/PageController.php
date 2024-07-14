<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Traits\StatusTrait;

class PageController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        return view('admin.page.index', [
            'pages' => Page::query()->select(['id', 'name', 'slug', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.page.create');
    }

    public function store(PageStoreRequest $request): RedirectResponse
    {
        $page = Page::create($request->safe()->except('image', 'banner_image'));

        if ($request->hasFile('banner_image')) {
            $page->storeImage('banner_image', 'page-images', $request->file('banner_image'), 1600, 600);
        }

        if ($request->hasFile('image')) {
            $page->storeImage('image', 'page-images', $request->file('image'), 600, 500);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page Created Successfully!');
    }


    public function show(Page $page): View
    {
        return view('admin.page.show', compact('page'));
    }

    public function edit(Page $page): View
    {
        return view('admin.page.edit', compact('page'));
    }

    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        $data = $request->safe()->except('image', 'banner_image', 'page_removed');

        if ((bool) $request->input('image_removed') === true) {
            $page->deleteImage('image', 'page-images');
            $data['image'] = null;
        }

        $page->update($data);

        if ($request->hasFile('image')) {
            $page->updateImage('image', 'page-images', $request->file('image'), 600, 500);
        }
        if ($request->hasFile('banner_image')) {
            $page->updateImage('banner_image', 'page-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page Updated Successfully!');
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->image) {
            $page->deleteImage('image', 'page-images');
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with('error', 'Page Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Page', $request->id, $request->status);
    }
}
