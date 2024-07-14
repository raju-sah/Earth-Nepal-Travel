<?php

namespace App\Services;

use App\Traits\EmptyCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAnalyticsService
{
    public function joined($startDate, $endDate, $tableName, $colName, $colData, $dateFilter = 'created_at')
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        $query = DB::table($tableName)
            ->selectRaw("DATE_FORMAT($dateFilter, '%Y-%m-%d') as day, count(*) as count")
            ->whereBetween($dateFilter, [$startDate, $endDate]);

        if ($colName !== "" && $colData !== "") {
            $query->where($colName, $colData);
        }

        $data = $query->groupBy('day')
            ->orderBy('day');

        return $data;
    }
}
