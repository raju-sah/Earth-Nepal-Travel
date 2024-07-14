<?php

namespace App\Http\Controllers\Front;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InquiryRequest;
use App\Mail\ContactEmail;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Models\SiteSetting;
use App\Models\User;
use App\Notifications\InquiryNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.pages.contact', [
            'contacts' => ContactUs::select()
        ]);
    }
    public function store(InquiryRequest $request): JsonResponse
    {
        $inquiry = Inquiry::create($data = $request->validated());
        $users = User::select(['id', 'email'])->where('user_type', UserType::Admin->value)->get();
        Notification::send($users, new InquiryNotification($inquiry));

        $siteSetting = SiteSetting::first();

        $data['contact_id'] = $inquiry->id;

        $mails = $siteSetting->email ? explode(",", $siteSetting->email) : ['info@southasiatrekking.com', 'southasiatrekking65@gmail.com'];

        Mail::to($mails)->send(new ContactEmail($data));

        return response()->json(['message' => 'Inquiry Created Successfully'], 201);
    }
}
