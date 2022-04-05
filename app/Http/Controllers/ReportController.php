<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $response = [
        'success' => true,
        'result' => [],
        'error' => []
    ];

    public function Report(Request $request)
    {
//        return "hello";
//        $report = DB::table('citizens')
//            ->select(DB::raw("EXTRACT(YEAR FROM citizens.created_at) as year, EXTRACT(MONTH FROM citizens.created_at) as month"),
//                DB::raw('COUNT(citizens.id) as citizens'),
//                DB::raw('COUNT(citizens.region_id = 8) as qoraqalpoq'),
////                DB::raw("sum(case when citizens.region_id=10 then 1 else 0 end) as count_advice"),
////                DB::raw("sum(case when citizen_services.service_id=11 then 1 else 0 end) as count_employment"),
////                DB::raw("sum(case when citizen_services.service_id=12 then 1 else 0 end) as count_employment_abroad"),
////                DB::raw("sum(case when citizen_services.service_id=13 then 1 else 0 end) as count_staffing_employer")
//            )
////            ->whereBetween('citizens.service_id', [10, 13])
//            ->groupBy('year', 'month')
//            ->orderBy('year')
//            ->get()->toArray();
//        return $report;
    }
}
