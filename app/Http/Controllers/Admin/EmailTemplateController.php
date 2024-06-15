<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SmartTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailTemplateStoreRequest;
use App\Http\Requests\Admin\EmailTemplateUpdateRequest;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailTemplateController extends Controller
{
    public function index(): View
    {
        return view('admin.email_template.index', [
            'email_templates' => EmailTemplate::select(['id', 'name'])->where('name', '!=', 'Custom Template')->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.email_template.create', [
            'smartTags' => SmartTags::cases(),
        ]);
    }

    public function store(EmailTemplateStoreRequest $request): RedirectResponse
    {
        EmailTemplate::create($request->validated());

        return redirect()->route('admin.email-templates.index')->with('success', 'Email Template Created Successfully!');
    }

    public function show(EmailTemplate $email_template): View
    {
        return view('admin.email_template.show', compact('email_template'));
    }

    public function edit(EmailTemplate $email_template): View
    {
        return view('admin.email_template.edit', [
            'email_template' => $email_template,
            'smartTags' => SmartTags::cases(),
        ]);
    }

    public function update(EmailTemplateUpdateRequest $request, EmailTemplate $email_template): RedirectResponse
    {
        $email_template->update($request->validated());

        return redirect()->route('admin.email-templates.index')->with('success', 'Email Template Updated Successfully!');
    }

    public function destroy(EmailTemplate $email_template): RedirectResponse
    {
        $email_template->delete();

        return redirect()->route('admin.email-templates.index')->with('error', 'Email Template Deleted Successfully!');
    }

    public function fetchEmailTemplate(Request $request): JsonResponse
    {
        return response()->json(['data' => EmailTemplate::select(['id', 'subject', 'body'])->whereId($request->template_id)->first()]);
    }

    /**
     * @throws \JsonException
     */
    public function emailReply(Request $request): ?RedirectResponse
    {
        try {
            (new EmailTemplateService())->sendEmail($request);
            return redirect()->back()->with('success', 'Email Sent Successfully!');
        } catch (\JsonException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
