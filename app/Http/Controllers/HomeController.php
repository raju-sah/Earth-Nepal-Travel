<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Activity;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\InquiryNotification;
use App\Services\ChartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected ChartService $chartService;

    public function __construct(ChartService $chartService)
    {
        $this->middleware('auth');
        $this->chartService = $chartService;
    }

    public function index(): View
    {
        return view('home', [
            'user_count' => User::count(),
            'package_count' => Package::count(),
            'inquiry_count' => Inquiry::count(),
            'testimonial_count' => Testimonial::count(),
            'destination_count' => Destination::count(),
            'activity_count' => Activity::count(),
            'service_count' => Service::count(),
            'team_count' => Team::count(),
            'packages' => Package::active()->pluck('title', 'id'),
        ]);
    }

    public function packageBasedInquiries(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->chartService->resolveInquiriesBasedOnPackage($request)]);
    }

    public function topRatedPackages(): JsonResponse
    {
        return response()->json(['data' => $this->chartService->resolveTopRatedPackages()]);
    }

    /*
     * this is a function to test only
     */
    public function contactPost(Request $request)
    {
        $inquiry = Inquiry::create($request->all());

        $users = User::where('user_type', UserType::Admin->value)->get();

        Notification::send($users, new InquiryNotification($inquiry));
    }
}
