<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Enums\MailEncryption;
use App\Http\Requests\Admin\Setting\SmptSettingUpdateRequest;

class SmtpSettingController extends Controller
{
    public function getSmtpDetails(SmtpSetting $smtpSettings): View
    {
        try {
            $smtpSetting = $smtpSettings->first();
            $encryptionOptions = MailEncryption::values();
        } catch (ModelNotFoundException $e) {
            $smtpSetting = null;
            $encryptionOptions = [];
        }

        return view('admin.setting.smtp_setting', [
            'smtpSettings' => $smtpSetting,
            'id' => $smtpSetting ? $smtpSetting->id : null,
            'encryptionOptions' => $encryptionOptions,
        ]);
    }   //end of method
    public function updateSmtpDetails(SmptSettingUpdateRequest $request, SmtpSetting $smtpSettings, $id = null): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($id) {
                $smtpSettings = SmtpSetting::find($id);
            }

            if (!$smtpSettings) {
                $smtpSettings = new SmtpSetting();
            }

            $smtpSettings->fill($request->validated());
            $smtpSettings->save();

            DB::commit();
            return redirect()->back()->with('success', 'SMTP Setting Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }   //end of method
}
