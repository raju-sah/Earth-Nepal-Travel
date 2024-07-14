<?php

namespace App\Http\Controllers\Admin;

use App\Traits\DatatableTrait;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\PackageReview;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageReviewStoreRequest;
use App\Http\Requests\Admin\PackageReviewUpdateRequest;
use App\Models\Package;
use App\Models\Testimonial;
use App\Traits\StatusTrait;

class PackageReviewController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PackageReview::select(['id', 'fullname', 'email', 'rating', 'package_id', 'status'])
                ->with('package:id,title')
                ->latest()->get();

            $config = [
                'additionalColumns' => [
                    'package_name' => function ($row) {
                        return $row->package?->title ?? 'N/A';
                    },
                    'rating' => function ($row) {
                        return $row->rating . '/5';
                    }
                ],
                'disabledButtons' => ['edit'],
                'model' => 'PackageReview',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => 'package-reviews',
            ];

            return $this->getDataTable($request, $data, $config)->make();
        }

        return view('admin.package_review.index', [
            'columns' => ['fullname', 'email', 'rating', 'package_name', 'status'],
        ]);
    }

    public function show(PackageReview $package_review, Package $package): View
    {
        $package_review->load('package:id,title');

        return view('admin.package_review.show', compact('package_review'));
    }

    public function destroy(PackageReview $package_review): RedirectResponse
    {
        $package_review->delete();

        return redirect()->route('admin.package-reviews.index')->with('error', 'PackageReview Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('PackageReview', $request->id, $request->status);
    }

    public function showPackageReview(PackageReview $package_review): View
    {
        return view('admin.package_review.show_notification', compact('package_review'));
    }
    public function showTestimonial(Testimonial $testimonial): View
    {
        return view('admin.testimonials.show_notification', compact('testimonial'));
    }
}
