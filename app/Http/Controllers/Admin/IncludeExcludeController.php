<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IncludeExcludeRequest;
use App\Http\Requests\Admin\IncludeExcludeUpdateRequest;
use App\Models\IncludeExclude;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IncludeExcludeController extends Controller
{
    public function index(Package $package): View
    {
        return view('admin.include_exclude.index', [
            'include_excludes' => IncludeExclude::query()->select(['id', 'includes', 'excludes'])->latest()->get()
        ]);
    }

    public function create(Package $package)
    {
        if ($package->include_exclude()->count() > 0) {
            $includeExclude = $package->include_exclude;

           /* return redirect()->route('admin.packages.include-excludes.edit', [
                'package' => $package->id,
                'include_exclude' => $includeExclude->id,
            ]);*/

            return view('admin.include_exclude.edit', [
                'package' => $package,
                'include_exclude' => $includeExclude
            ]);
        }

        return view('admin.include_exclude.create', [
            'package' => $package
        ]);
    }

    public function store(IncludeExcludeRequest $request, Package $package): RedirectResponse
    {
        $package->include_exclude()->create($request->validated());

        return redirect()->route('admin.packages.packages-gallery.create', $package->id)->with('success', 'Include Exclude Created Successfully!');
    }

    public function show(Package $package, IncludeExclude $include_exclude): View
    {
        return view('admin.include_exclude.show', compact('include_exclude'));
    }

    public function edit(Package $package, IncludeExclude $include_exclude): View
    {
        return view('admin.include_exclude.edit', [
            'package' => $package,
            'include_exclude' => $include_exclude,
        ]);
    }

    public function update(IncludeExcludeUpdateRequest $request, Package $package, IncludeExclude $include_exclude): RedirectResponse
    {
        $include_exclude->update($request->validated());

        return redirect()->route('admin.packages.packages-gallery.create', $package->id)->with('success', 'Include Exclude Created Successfully!');
    }

    public function destroy(Package $package, IncludeExclude $include_exclude): RedirectResponse
    {
        $include_exclude->delete();

        return redirect()->route('admin.include-excludes.index')->with('error', 'Include Exclude Deleted Successfully!');
    }
}
