<?php

namespace App\Http\Controllers\Admin;

use App\Traits\DatatableTrait;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Icon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IconRequest;
use App\Http\Requests\Admin\IconUpdateRequest;

class IconController extends Controller
{
    use DatatableTrait;

    public function index(Request $request)
    {
       /* return view('admin.icon.index', [
            'icons' => Icon::query()->select(['id', 'name', 'image'])->latest()->get()
        ]);*/

        $this->authorize('access-destination-page');

        if ($request->ajax()) {
            $data = Icon::query()->select(['id', 'name', 'image'])->latest()->get();

            $config = [
                'additionalColumns' => [
                    'image' => function ($row) {
                        return view('components.form.table_image', [
                            'url' => $row->image_path,
                        ])->render();
                    }
                ],
                'disabledButtons' => ['edit'],
                'model' => 'Icon',
                'rawColumns' => ['image'],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.icon.index', [
            'columns' => ['name', 'image'],
        ]);
    }

    public function create(): View
    {
        return view('admin.icon.create');
    }

    public function store(IconRequest $request): RedirectResponse
    {
        $icon = Icon::create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $imageName = Str::kebab($request->name).'.'.$request->file('image')?->extension();
            $icon->storeImage('image', 'icon-images', $request->file('image'), $imageName);
        }

        return back()->with('success', 'Icon Created Successfully!');
    }

    public function show(Icon $icon): View
    {
        return view('admin.icon.show', compact('icon'));
    }

    public function edit(Icon $icon): View
    {
        return view('admin.icon.edit', compact('icon'));
    }

    public function update(IconUpdateRequest $request, Icon $icon): RedirectResponse
    {
        $icon->update($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $imageName = Str::kebab($request->name).'.'.$request->file('image')?->extension();
            $icon->updateImage('image', 'icon-images', $request->file('image'), $imageName);
        }

        return redirect()->route('admin.icons.index')->with('success', 'Icon Updated Successfully!');
    }

    public function destroy(Icon $icon): RedirectResponse
    {
        if ($icon->image) {
            $icon->deleteImage('image', 'icon-images');
        }

        $icon->delete();

        return redirect()->route('admin.icons.index')->with('error', 'Icon Deleted Successfully!');
    }


}
