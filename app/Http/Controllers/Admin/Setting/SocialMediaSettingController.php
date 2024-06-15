<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SocialMediaSetting;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Setting\SocialMediaSettingRequest;
use App\Http\Requests\Admin\Setting\SocialMediaSettingUpdateRequest;

class SocialMediaSettingController extends Controller
{
    public function index(): View
    {
        return view('admin.setting.social_media_setting.index', [
            'social_media_settings' => SocialMediaSetting::query()->select(['id', 'name', 'social_icon', 'social_link', 'slug'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.setting.social_media_setting.create');
    }

    public function store(SocialMediaSettingRequest $request): RedirectResponse
    {
        $socialmediasetting = SocialMediaSetting::create($request->safe()->except('social_icon'));
        if ($request->hasFile('social_icon')) {
            $socialmediasetting->storeImage('social_icon', 'social-icon-images', $request->file('social_icon'));
        }

        return redirect()->route('admin.setting.social-media-settings.index')->with('success', 'Social Media Created Successfully!');
    }

    public function show(SocialMediaSetting $social_media_setting): View
    {
        return view('admin.setting.social_media_setting.show', compact('social_media_setting'));
    }

    public function edit(SocialMediaSetting $social_media_setting): View
    {

        return view('admin.setting.social_media_setting.edit', compact('social_media_setting'));
    }

    public function update(SocialMediaSettingUpdateRequest $request, SocialMediaSetting $social_media_setting): RedirectResponse
    {
        $social_media_setting->update($request->safe()->except('social_icon'));
        if ($request->hasFile('social_icon')) {
            $social_media_setting->updateImage('social_icon', 'social-icon-images', $request->file('social_icon'));
        }

        return redirect()->route('admin.setting.social-media-settings.index')->with('success', 'Social Media Updated Successfully!');
    }

    public function destroy(SocialMediaSetting $social_media_setting): RedirectResponse
    {
        if ($social_media_setting->social_icon) {
            $social_media_setting->deleteImage('social_icon', 'social-icon-images');
        }
        $social_media_setting->delete();
        return redirect()->route('admin.setting.social-media-settings.index')->with('error', 'Social Media Deleted Successfully!');
    }


}
