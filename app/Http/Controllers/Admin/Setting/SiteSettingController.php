<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Admin\Setting\SiteSettingUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    public function getCompanyDetails(SiteSetting $siteSettings): View
    {
        try {
            $siteSetting = $siteSettings->first();
        } catch (ModelNotFoundException $e) {
            $siteSetting = null;
        }

        return view('admin.setting.site_setting', [
            'siteSettings' => $siteSetting,
            'id' => $siteSetting ? $siteSetting->id : null,
        ]);
    }   //end of method
    public function updateCompanyDetails(SiteSettingUpdateRequest $request, SiteSetting $siteSettings, $id = null): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($id) {
                $siteSettings = SiteSetting::find($id);
            }

            if (!$siteSettings) {
                $siteSettings = new SiteSetting();
            }

            $siteSettings->fill($request->validated());
            $siteSettings->save();

            $this->handleFileUploads($siteSettings, $request);

            DB::commit();
            return redirect()->back()->with('success', 'Company Setting Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }   //end of method

    private function handleFileUploads(SiteSetting $siteSettings, SiteSettingUpdateRequest $request): void
    {
        if ($request->hasFile('logo')) {
            if ($siteSettings->logo) {
                $siteSettings->updateLogo('logo', 'site-setting-images', $request->file('logo'));
            } else {
                $siteSettings->storeLogo('logo', 'site-setting-images', $request->file('logo'));
            }
        }

        if ($request->hasFile('favicon')) {
            if ($siteSettings->favicon) {
                $siteSettings->updateFavicon('favicon', 'site-setting-images', $request->file('favicon'));
            } else {
                $siteSettings->storeFavicon('favicon', 'site-setting-images', $request->file('favicon'));
            }
        }
    }
    //end of method
}
