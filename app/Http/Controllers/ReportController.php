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
            $report_count = DB::table('citizens')
                            ->select(
                                DB::raw('COUNT(citizens) as citizens_count'),
                                DB::raw("sum(case when citizens.social_areas_id=1 then 1 else 0 end) as count_social1"),
                                DB::raw("sum(case when citizens.social_areas_id=2 then 1 else 0 end) as count_social2"),
                                DB::raw("sum(case when citizens.social_areas_id=3 then 1 else 0 end) as count_social3"),
                                DB::raw("sum(case when citizens.social_areas_id=4 then 1 else 0 end) as count_social4"),
                                DB::raw("sum(case when citizens.social_areas_id=5 then 1 else 0 end) as count_social5"),
                                DB::raw("sum(case when citizens.social_areas_id=6 then 1 else 0 end) as count_social6"),
                                DB::raw("sum(case when citizens.social_areas_id=7 then 1 else 0 end) as count_social7"),
                                DB::raw("sum(case when citizens.social_areas_id=8 then 1 else 0 end) as count_social8"),
                                DB::raw("sum(case when citizens.social_areas_id=9 then 1 else 0 end) as count_social9"),
                                DB::raw("sum(case when citizens.social_areas_id=10 then 1 else 0 end) as count_social10"),
                                DB::raw("sum(case when citizens.social_areas_id=11 then 1 else 0 end) as count_social11"),
                                DB::raw("sum(case when citizens.social_areas_id=12 then 1 else 0 end) as count_social12"),
                                DB::raw("sum(case when citizens.social_areas_id=13 then 1 else 0 end) as count_social13"),
                                DB::raw("sum(case when citizens.social_areas_id=14 then 1 else 0 end) as count_social14"),
                                DB::raw("sum(case when citizens.social_areas_id=15 then 1 else 0 end) as count_social15"),
                                DB::raw("sum(case when citizens.social_areas_id=16 then 1 else 0 end) as count_social16"),
                                DB::raw("sum(case when citizens.social_areas_id=17 then 1 else 0 end) as count_social17"),
                                DB::raw("sum(case when citizens.social_areas_id=18 then 1 else 0 end) as count_social18"),
                            )
                ->get()->toArray();
            $report = DB::table('citizens')
                ->leftJoin('regions', 'citizens.region_id', '=', 'regions.id')
                ->select(
                    'regions.name_cyrl as region_name',
                    'regions.id as region_id',
                    DB::raw('COUNT(citizens.region_id) as region_count'),
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
                ->groupBy('regions.id', 'regions.name_cyrl')
                ->orderBy('regions.id')
                ->get()->toArray();
        return response()->successJson(['report' => $report, 'report_count' => $report_count]);
    }

    public function ReportCity($id){
        $report_count = DB::table('citizens')
            ->where('citizens.region_id','=' ,$id)
            ->select(
                DB::raw('COUNT(citizens) as citizens_count'),
                DB::raw("sum(case when citizens.social_areas_id=1 then 1 else 0 end) as count_social1"),
                DB::raw("sum(case when citizens.social_areas_id=2 then 1 else 0 end) as count_social2"),
                DB::raw("sum(case when citizens.social_areas_id=3 then 1 else 0 end) as count_social3"),
                DB::raw("sum(case when citizens.social_areas_id=4 then 1 else 0 end) as count_social4"),
                DB::raw("sum(case when citizens.social_areas_id=5 then 1 else 0 end) as count_social5"),
                DB::raw("sum(case when citizens.social_areas_id=6 then 1 else 0 end) as count_social6"),
                DB::raw("sum(case when citizens.social_areas_id=7 then 1 else 0 end) as count_social7"),
                DB::raw("sum(case when citizens.social_areas_id=8 then 1 else 0 end) as count_social8"),
                DB::raw("sum(case when citizens.social_areas_id=9 then 1 else 0 end) as count_social9"),
                DB::raw("sum(case when citizens.social_areas_id=10 then 1 else 0 end) as count_social10"),
                DB::raw("sum(case when citizens.social_areas_id=11 then 1 else 0 end) as count_social11"),
                DB::raw("sum(case when citizens.social_areas_id=12 then 1 else 0 end) as count_social12"),
                DB::raw("sum(case when citizens.social_areas_id=13 then 1 else 0 end) as count_social13"),
                DB::raw("sum(case when citizens.social_areas_id=14 then 1 else 0 end) as count_social14"),
                DB::raw("sum(case when citizens.social_areas_id=15 then 1 else 0 end) as count_social15"),
                DB::raw("sum(case when citizens.social_areas_id=16 then 1 else 0 end) as count_social16"),
                DB::raw("sum(case when citizens.social_areas_id=17 then 1 else 0 end) as count_social17"),
                DB::raw("sum(case when citizens.social_areas_id=18 then 1 else 0 end) as count_social18"),
            )
            ->get()->toArray();

        $report = DB::table('citizens')
            ->where('citizens.region_id','=' ,$id)
            ->leftJoin('cities','citizens.city_id','=','cities.id')
            ->select(
                'cities.name_cyrl as region_name',
                'cities.id as region_id',
                DB::raw('COUNT(citizens.city_id) as region_count'),
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
            ->groupBy('cities.id','cities.name_cyrl')
            ->orderBy('cities.id')
            ->get()->toArray();
        return response()->successJson(['report' => $report, 'report_count' => $report_count]);
    }
}
