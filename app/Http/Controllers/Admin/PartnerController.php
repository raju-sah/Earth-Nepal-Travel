<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PartnerType;
use App\Traits\DatatableTrait;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerStoreRequest;
use App\Http\Requests\Admin\PartnerUpdateRequest;
use App\Traits\StatusTrait;

class PartnerController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Partner::select(['id', 'name', 'image', 'type', 'status'])->latest()->get();

            $config = [
                'additionalColumns' => [
                    'image' => function ($row) {
                        return view('components.form.table_image', ['name' => $row->image, 'url' => $row->image_path])->render();
                    },
                ],
                'disabledButtons' => [],
                'model' => 'Partner',
                'rawColumns' => ['image'],
                'sortable' => false,
                'routeClass' => 'partners',
            ];

            return $this->getDataTable($request, $data, $config)->make();
        }

        return view('admin.partner.index', [
            'columns' => ['name', 'image', 'type', 'status'],
        ]);
    }

    public function create(): View
    {
        return view('admin.partner.create', [
            'partnerTypes' => PartnerType::cases(),
        ]);
    }

    public function store(PartnerStoreRequest $request): RedirectResponse
    {
        $partner = Partner::create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $partner->storeImage('image', 'partner-images', $request->file('image'),120,120);
        }

        return redirect()->route('admin.partners.index')->with('success', 'Partner Created Successfully!');
    }

    public function show(Partner $partner): View
    {
        return view('admin.partner.show', compact('partner'));
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partner.edit', [
            'partner' => $partner,
            'partnerTypes' => PartnerType::cases(),
        ]);
    }

    public function update(PartnerUpdateRequest $request, Partner $partner): RedirectResponse
    {
        $partner->update($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            $partner->updateImage('image', 'partner-images', $request->file('image'),120,120);
        }

        return redirect()->route('admin.partners.index')->with('success', 'Partner Updated Successfully!');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->image) {
            $partner->deleteImage('image', 'partner-images');
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('error', 'Partner Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Partner', $request->id, $request->status);
    }
}
