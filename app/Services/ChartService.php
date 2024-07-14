<?php

namespace App\Services;

use App\Models\Package;
use App\Traits\EmptyCollectionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChartService
{
    use EmptyCollectionTrait;

    public function resolveInquiriesBasedOnPackage(Request $request)
    {
        $data = DB::table('inquiries')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as x, count(*) as y")
            ->where(['inquiriable_type' => Package::class, 'inquiriable_id' => $request->package_id])
            ->whereBetween('created_at', [Carbon::parse($request->from_date)->startOfDay(), Carbon::parse($request->end_date)->endOfDay()])
            ->groupBy('x')->orderBy('x')
            ->get();

        return $this->emptyCollection($request->from_date, $request->to_date)->merge($data->keyBy('x'))->values();
    }

    public function resolveTopRatedPackages(): Collection
    {
        return DB::table('package_reviews')
            ->select( 'packages.title as x', DB::raw('CEIL(AVG(rating)) as y'))
            ->join('packages', 'packages.id', '=', 'package_reviews.package_id')
            ->where('packages.status', '=', 1)
            ->groupBy('packages.id', 'packages.title')
            ->orderBy('y', 'desc')
            ->take(5)
            ->get();
    }
}
