<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{

    public function index(): View
    {
        return view('front.pages.packages.package_list', [
            'packages' => Package::select('packages.id', 'packages.title', 'packages.image', 'packages.duration_type', 'packages.duration_value', 'packages.starting_location', 'packages.overview', 'packages.price')
                ->with(['activities' => function ($query) {
                    $query->select('activities.id', 'activities.title')->with('images');
                }])
                ->withAvgRating()
                ->withCount(['reviews' => function ($query) {
                    $query->where('status', 1);
                }])
                ->whereNull('packages.journey_type')
                ->active()
                ->take(20)
                ->get(),
        ]);
    }


    public function show($slug)
    {
        $packageDetails = Package::where('slug', $slug)->active()->first();
        $relatedPackages = Package::active()
            ->where('slug', '!=', $slug)
            ->select('title', 'slug', 'image', 'price', 'overview')
            ->withAvgRating()
            ->take(10)
            ->get();

        $relatedDestinations = $packageDetails->destinations()
            ->active()
            ->whereNull('parent_id')
            ->select('title', 'slug', 'image')
            ->orderBy('destinations.created_at', 'desc')
            ->take(10)
            ->get();

        return view('front.pages.packages.package_detail', [
            'packageDetails' => $packageDetails,
            'relatedPackages' => $relatedPackages,
            'relatedDestinations' => $relatedDestinations
        ]);
    }


    public function search(Request $request)
    {
        $packages = Package::active()
            ->select('id', 'title', 'slug', 'image', 'price', 'overview')
            ->withAvgRating()
            ->withCount(['reviews' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('overview', 'like', '%' . $request->search . '%')
            ->get();
        return view('front.pages.packages.package_list', [
            'packages' => $packages
        ]);
    }
}
