<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SeoSettingUpdateRequest;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SeoSettingController extends Controller
{
    public function getSeoDetails(SeoSetting $seoSettings): View
    {
        try {
            $seoSetting = $seoSettings->first();
        } catch (ModelNotFoundException $e) {
            $seoSetting = null;
        }

        return view('admin.setting.seo_setting', [
            'seoSettings' => $seoSetting,
            'id' => $seoSetting ? $seoSetting->id : null,
        ]);
    }   //end of method
    public function updateSeoDetails(SeoSettingUpdateRequest $request, SeoSetting $seoSettings, $id = null): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($id) {
                $seoSettings = SeoSetting::find($id);
            }

            if (!$seoSettings) {
                $seoSettings = new SeoSetting();
            }

            $seoSettings->fill($request->validated());
            $seoSettings->save();

            DB::commit();
            return redirect()->back()->with('success', 'SEO Setting Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }   //end of method
}
