<?php

namespace App\Services;

use App\Enums\SmartTags;
use App\Mail\TemplateEmail;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTemplateService
{
    /**
     * @throws \JsonException
     */
    private static function replaceKeyWords(Request $request): array
    {
        $siteSetting = SiteSetting::first();
        $modelData = json_decode($request->input('model'), true, 512, JSON_THROW_ON_ERROR);
        $keyWordsArray = array_column(SmartTags::cases(), 'value');
        $companyName = $siteSetting ? $siteSetting->name : 'Our Company';

        $keyWordsReplacementArray = [
            $modelData['name'] ?? 'Customer', //customer_name
            $modelData['package_name'] ?? 'Wonderful Package', //package_name
            auth()->user()->name ?? 'Admin', //admin_name
            $companyName //company_name
        ];

        $formattedSubject = str_replace(
            $keyWordsArray,
            $keyWordsReplacementArray,
            $request->subject
        );

        $formattedBody = str_replace(
            $keyWordsArray,
            $keyWordsReplacementArray,
            $request->body
        );

        return [
            'subject' => $formattedSubject,
            'body' => $formattedBody,
            'admin_address' => $siteSetting ? $siteSetting->email : 'admin@example.com',
            'customer_address' => $modelData['email'] ?? 'customer@example.com',
            'company_name' => $companyName,
            'company_phone' => $siteSetting ? $siteSetting->phone : 'Contact Us',
            'company_address' => $siteSetting ? $siteSetting->contact_address : 'Our Company Address',
        ];
    }

    /**
     * @throws \JsonException
     */
    public function sendEmail(Request $request): void
    {
        $data = self::replaceKeyWords($request);

        Mail::to($data['customer_address'])->send(new TemplateEmail($data));
    }
}
