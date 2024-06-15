<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactUsRequest;
use App\Http\Requests\Admin\ContactUsUpdateRequest;
use App\Models\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function index(): View
    {
        return view('admin.contact_us.index', [
            'contact_uses' => ContactUs::query()->select(['id', 'page_title', 'banner_image', 'content_title', 'description', 'image'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        $contact_us = ContactUs::first();

        if (!is_null($contact_us)) {
            return view('admin.contact_us.edit', compact('contact_us'));
        }
        return view('admin.contact_us.create');
    }

    public function store(ContactUsRequest $request): RedirectResponse
    {
        $contactus = ContactUs::create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $contactus->storeImage('image', 'contactus-images', $request->file('image'));
        }
        if ($request->hasFile('banner_image')) {
            $contactus->storeImage('banner_image', 'contactus-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.contact-uses.create')->with('success', 'ContactUs Created Successfully!');
    }

    public function show(ContactUs $contact_us): View
    {
        return view('admin.contact_us.show', compact('contact_us'));
    }

    public function edit(ContactUs $contact_us): View
    {
        return view('admin.contact_us.edit', compact('contact_us'));
    }

    public function update(ContactUsUpdateRequest $request, ContactUs $contact_us): RedirectResponse
    {
        $contact_us->update($request->safe()->except('image', 'banner_image'));

        if ($request->hasFile('image')) {
            $contact_us->updateImage('image', 'contactus-images', $request->file('image'));
        }
        if ($request->hasFile('banner_image')) {
            $contact_us->updateImage('banner_image', 'contactus-images', $request->file('banner_image'), 1600, 600);
        }

        return redirect()->route('admin.contact-uses.edit', $contact_us)->with('success', 'ContactUs Updated Successfully!');
    }

    public function destroy(ContactUs $contact_us): RedirectResponse
    {
        if ($contact_us->image) {
            $contact_us->deleteImage('image', 'contactus-images');
        }
        $contact_us->delete();
        return redirect()->route('admin.contact-uses.index')->with('error', 'ContactUs Deleted Successfully!');
    }
}
