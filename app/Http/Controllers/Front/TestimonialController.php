<?php

namespace App\Http\Controllers\Front;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Mail\TestimonialEmail;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\InquiryNotification;
use App\Notifications\TestimonialSubmittedNotification;
use App\Traits\UploadFileTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use UploadFileTrait;
    public function index(): View
    {
        $testimonials = Testimonial::query()->select(['id', 'name', 'email', 'rating',  'image', 'description'])->active()->latest()->get();
        return view('front.pages.testimonial', compact('testimonials'));
    }

    public function store(TestimonialRequest $request): JsonResponse
    {
        $data = $request->safe()->except('image');
        $testimonial = Testimonial::create($data);

        if ($request->hasFile('image')) {
            $testimonial->storeImage('image', 'testimonial-images', $request->file('image'), 120, 120);
        }
        $data['testimonial_id'] = $testimonial->id;

        $users = User::select(['id', 'email'])->where('user_type', UserType::Admin->value)->get();
        Notification::send($users, new TestimonialSubmittedNotification($testimonial));
        $siteSetting = SiteSetting::first();
        $mails = $siteSetting->email ? explode(",", $siteSetting->email) : ['info@southasiatrekking.com', 'southasiatrekking65@gmail.com'];
        if (isset($data['email'])) {
            Mail::to($mails)->send(new TestimonialEmail($data));
            return response()->json(['message' => 'Testimonial Created Successfully'], 201);
        } else {
            // Handle the case where email is not provided
            return response()->json(['message' => 'Email is required'], 400);
        }
    }
}
