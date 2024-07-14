<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageFaqCommonFaqRequest;
use App\Http\Requests\Admin\PackageFaqRequest;
use App\Http\Requests\Admin\PackageFaqUpdateRequest;
use App\Models\CommonFaq;
use App\Models\Package;
use App\Models\PackageFaq;
use App\Traits\RowReOrderingTrait;
use App\Traits\StatusTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageFaqController extends Controller
{
    use StatusTrait;
    use RowReOrderingTrait;

    public function index(Package $package): JsonResponse
    {
        $package_faq = PackageFaq::query()
            ->select(['id', 'question', 'answer', 'status', 'package_id', 'order'])
            ->where('package_id', $package->id)
            ->orderBy('order')
            ->get();

        return response()->json(['package_faq' => $package_faq]);
    }

    public function create(Package $package): View
    {
        $package->load('package_faqs', 'common_faqs');

        $common_faqs = CommonFaq::query()->active()->pluck('question', 'id');

        return view('admin.package_faq.create', [
            'package' => $package,
            'common_faqs' => $common_faqs,
        ]);
    }

    public function store(PackageFaqRequest $request, Package $package): JsonResponse
    {
        $package_faq = $package->package_faqs()->create($request->validated());

        return response()->json(['data' => $package_faq, 'message' => 'Package FAQ created successfully.']);
    }

    public function show(Package $package, PackageFaq $package_faq): View
    {
        return view('admin.package_faq.show', compact('package_faq'));
    }

    public function edit(Package $package, PackageFaq $package_faq): JsonResponse
    {
        $common_faqs = CommonFaq::query()->active()->pluck('question', 'id');
        return response()->json(['package_faq' => $package_faq, 'common_faqs' => $common_faqs]);
    }

    public function update(PackageFaqUpdateRequest $request, Package $package, PackageFaq $package_faq): JsonResponse
    {
        $package_faq->update($request->validated());

        $package_faqs = PackageFaq::find($package_faq->id);

        return response()->json(['message' => 'Package FAQ updated successfully.', 'update_data' => $package_faqs]);
    }

    public function destroy(Package $package, PackageFaq $package_faq): JsonResponse
    {
        $package_faq->delete();

        return response()->json(['message' => 'Package FAQ deleted successfully.', 'deleted_data_id' => $package_faq->id]);
    }

    public function bulkDelete(Request $request, Package $package): JsonResponse
    {
       PackageFaq::whereIn('id', $request->ajax_requested_ids)->where('package_id', $package->id)->delete(); 
       
        return response()->json([
            'data' => $request->ajax_requested_ids,
            'message' => 'Itineraries Details deleted successfully'
        ]);
    }

    public function rowReOrder(Package $package): void
    {
        $package_faq = PackageFaq::select(['id', 'order'])->where('package_id', $package->id)->get();
        $this->reOrder($package_faq);
    }

    public function storeCommonFaqs(PackageFaqCommonFaqRequest $request, Package $package): RedirectResponse
    {
        $package->common_faqs()->sync($request->common_faqs);

        return redirect()->back()->with('success', 'Common FAQs updated successfully.');
    }
}
