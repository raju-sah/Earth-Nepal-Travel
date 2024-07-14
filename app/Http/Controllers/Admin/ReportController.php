<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommonFilterType;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\PackageReview;
use App\Traits\DatatableTrait;
use App\Traits\StatusTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\HtmlString;
use Illuminate\View\View;

class ReportController extends Controller
{
    use StatusTrait, DatatableTrait;

    public function reportFilter(Request $request)
    {
        if ($request->ajax()) {

            $startDate = Carbon::parse($request->from_date)->startOfDay();
            $endDate = Carbon::parse($request->to_date)->endOfDay();

            $query = Package::query()->select(['id', 'title', 'slug', 'view_count','journey_type', 'created_at'])
                ->withAvgRating()
                ->withCount(['inquiries'])
                ->whereBetween('created_at', [$startDate, $endDate]);

            if ($request->has('common_filter')) {
                switch ($request->common_filter) {
                    case CommonFilterType::Views->value:
                        $query->orderBy('view_count', $request->asc_desc_filter);
                        break;
                    case CommonFilterType::Ratings->value:
                        $query->orderBy('reviews_avg_rating', $request->asc_desc_filter);
                        break;
                    case CommonFilterType::Inquiries->value:
                        $query->orderBy('inquiries_count', $request->asc_desc_filter);
                        break;
                    default:
                        $query->orderBy('created_at', $request->asc_desc_filter);
                        break;
                }
            } else {
                $query->orderBy('created_at', $request->asc_desc_filter);
            }

            $config = [
                'additionalColumns' => [
                    'avg_rating' => function ($row) {
                        return $row->reviews_avg_rating . '/5';
                    },
                    'inquiries' => function ($row) {
                        return $row->inquiries_count;
                    },
                    'created_at' => function ($row) {
                        return $row->created_at->format('Y-m-d');
                    },
                    'journey_type' => function ($row) {
                        $journeyType = $row->journey_type ? $row->journey_type : 'N/A';
                        $badgeClass = $row->journey_type ? 'bg-info' : 'bg-danger';
                        return new HtmlString('<span class="badge ' . $badgeClass . '">' . $journeyType . '</span>');
                    },

                    'report_button' => function ($row) {
                        return '<a href="'.route('admin.package-reports.index', ['package' => $row->id]).'" class=""><i class="bx bxs-report"></i></a>';
                    },

                ],
                'disabledButtons' => ['edit', 'delete', 'view'],
                'model' => 'Package',
                'rawColumns' => ['report_button'],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $query, $config)->make(true);
        }

        return view('admin.report.package_report_filters', [
            'columns' => ['title', 'slug','journey_type', 'view_count', 'avg_rating', 'inquiries', 'created_at', 'report_button'],
        ]);
    }

    public function packageReport(Request $request): View
    {
        return view('admin.report.package_report', [
            'packages' => Package::active()->pluck('title', 'id'),
            'filtered_package' => Package::select(['id', 'title', 'slug', 'image', 'view_count', 'highlight','journey_type'])
                ->active()
                ->where('id', $request->package)
                ->withAvgRating()
                ->withCount([
                    'reviews' => function ($query) {
                        $query->where('status', 1);
                    }
                ])
                ->withCount('itineraries')
                ->withCount('equipments')
                ->withCount('inquiries')
                ->addSelect([
                    'highest_rating' => PackageReview::selectRaw('MAX(rating)')->where('package_id', $request->package),
                    'lowest_rating' => PackageReview::selectRaw('MIN(rating)')->where('package_id', $request->package)
                ])
                ->first(),

            'inquiries' => Inquiry::query()
                ->select(['id', 'name', 'email', 'phone', 'subject', 'created_at'])
                ->where('inquiriable_type', 'App\Models\Package')
                ->where('inquiriable_id', $request->package)
                ->latest()->limit(5)->get(),

            'highest_ratings' => PackageReview::select('id', 'rating', 'fullname', 'email', 'created_at')
                ->where('package_id', $request->package)->orderBy('rating', 'desc')->limit(3)->get(),
            'lowest_ratings' => PackageReview::select('id', 'rating', 'fullname', 'email', 'created_at')
                ->where('package_id', $request->package)->orderBy('rating', 'asc')->limit(3)->get(),
            'latest_ratings' => PackageReview::select('id', 'rating', 'fullname', 'email', 'created_at')
                ->where('package_id', $request->package)->latest()->limit(5)->get()
        ]);
    }

    public function generatePDF(Request $request): Response
    {
        $filtered_package = Package::select(['id', 'title', 'slug', 'image', 'view_count', 'highlight'])
            ->where('status', 1)
            ->where('id', $request->package_id)
            ->withAvgRating()
            ->withCount([
                'reviews' => function ($query) {
                    $query->where('status', 1);
                }
            ])->withCount('itineraries')
            ->withCount('equipments')
            ->withCount('inquiries')
            ->addSelect([
                'highest_rating' => PackageReview::selectRaw('MAX(rating)')->where('package_id', $request->package_id),
                'lowest_rating' => PackageReview::selectRaw('MIN(rating)')->where('package_id', $request->package_id)
            ])->first();

        $pdf = Pdf::loadView('admin.pdf.package_pdf', [
            'filtered_package' => $filtered_package,

            'inquiries' => Inquiry::query()
                ->select(['id', 'name', 'email', 'phone', 'subject', 'created_at'])
                ->where('inquiriable_type', 'App\Models\Package')
                ->where('inquiriable_id', $request->package_id)
                ->latest()->limit(5)->get(),

            'highest_ratings' => PackageReview::select(['rating', 'fullname', 'email', 'created_at'])
                ->where('package_id', $request->package_id)->orderBy('rating', 'desc')->limit(3)->get(),
            'lowest_ratings' => PackageReview::select(['rating', 'fullname', 'email', 'created_at'])
                ->where('package_id', $request->package_id)->orderBy('rating')->limit(3)->get(),
            'latest_ratings' => PackageReview::select(['rating', 'fullname', 'email', 'created_at'])
                ->where('package_id', $request->package_id)->latest()->limit(5)->get()
        ]);
        return $pdf->download($filtered_package->getPDFFileName('package-report_'));
    }
}
