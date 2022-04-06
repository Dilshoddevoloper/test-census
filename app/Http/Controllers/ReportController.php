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
//        DB::table('regions')->leftJoin('citizens', function ($join) {
//            $join->on('regions.id', '=', 'citizens.region_id');
//        })
        $report = DB::table('citizens')
            ->leftJoin('regions','regions.id','citizens.region_id')
            ->select(
                DB::raw('citizens.regions. as region'),
                DB::raw("sum(case when citizens.social_areas_id=1 then 1 else 0 end) as social1"),
                DB::raw("sum(case when citizens.social_areas_id=2 then 1 else 0 end) as social2"),
                DB::raw("sum(case when citizens.social_areas_id=3 then 1 else 0 end) as social3"),
                DB::raw("sum(case when citizens.social_areas_id=4 then 1 else 0 end) as social4"),
                DB::raw("sum(case when citizens.social_areas_id=5 then 1 else 0 end) as social5"),
                DB::raw("sum(case when citizens.social_areas_id=6 then 1 else 0 end) as social6"),
                DB::raw("sum(case when citizens.social_areas_id=7 then 1 else 0 end) as social7"),
                DB::raw("sum(case when citizens.social_areas_id=8 then 1 else 0 end) as social8"),
                DB::raw("sum(case when citizens.social_areas_id=9 then 1 else 0 end) as social9"),
                DB::raw("sum(case when citizens.social_areas_id=10 then 1 else 0 end) as social10"),
                DB::raw("sum(case when citizens.social_areas_id=11 then 1 else 0 end) as social11"),
                DB::raw("sum(case when citizens.social_areas_id=12 then 1 else 0 end) as social12"),
                DB::raw("sum(case when citizens.social_areas_id=13 then 1 else 0 end) as social13"),
                DB::raw("sum(case when citizens.social_areas_id=14 then 1 else 0 end) as social14"),
                DB::raw("sum(case when citizens.social_areas_id=15 then 1 else 0 end) as social15"),
                DB::raw("sum(case when citizens.social_areas_id=16 then 1 else 0 end) as social16"),
                DB::raw("sum(case when citizens.social_areas_id=17 then 1 else 0 end) as social17"),
                DB::raw("sum(case when citizens.social_areas_id=18 then 1 else 0 end) as social18"),
            )
            ->groupBy('region_id')
            ->orderBy('region_id')
            ->get()->toArray();
        return response()->successJson(['report' => $report]);
    }
}
