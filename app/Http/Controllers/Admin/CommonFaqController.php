<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\CommonFaq;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommonFaqRequest;
use App\Http\Requests\Admin\CommonFaqUpdateRequest;
use App\Traits\StatusTrait;

class CommonFaqController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.common_faq.index', [
            'common_faqs' => CommonFaq::query()->select(['id', 'question', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.common_faq.create');
    }

    public function store(CommonFaqRequest $request): RedirectResponse
    {
        CommonFaq::create($request->validated());

        return redirect()->route('admin.common-faqs.index')->with('success', 'CommonFaq Created Successfully!');
    }

    public function show(CommonFaq $common_faq): View
    {
        return view('admin.common_faq.show', compact('common_faq'));
    }

    public function edit(CommonFaq $common_faq): View
    {
        return view('admin.common_faq.edit', compact('common_faq'));
    }

    public function update(CommonFaqUpdateRequest $request, CommonFaq $common_faq): RedirectResponse
    {
        $common_faq->update($request->validated());

        return redirect()->route('admin.common-faqs.index')->with('success', 'CommonFaq Updated Successfully!');
    }

    public function destroy(CommonFaq $common_faq): RedirectResponse
    {
        $common_faq->delete();

        return redirect()->route('admin.common-faqs.index')->with('error', 'CommonFaq Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('CommonFaq', $request->id, $request->status);
    }
}
