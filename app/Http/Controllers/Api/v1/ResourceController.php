<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Region\IndexRequest as RegionRequest;
use App\Http\Requests\City\IndexRequest as CityRequest;
use App\Region;
use App\Services\CityService;
use App\Services\RegionService;
use App\SocialAreas;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    private $regionService;
    private $cityService;

    public function __construct(RegionService $regionService, CityService $cityService)
    {
        $this->regionService = $regionService;
        $this->cityService = $cityService;
    }

//    public function regions(RegionRequest $request)
//    {
//        $params = $request->validated();
//        return response()->successJson($this->regionService->get($params));
//    }
//
//    public function cities(CityRequest $request)
//    {
//        $params = $request->validated();
//        return response()->successJson($this->cityService->get($params));
//    }

    public function regions(Region $region)
    {
        $regions = Region::all();
        return response()->successJson(['regions' => $regions]);
    }

    public function social_areas(SocialAreas $social_areas)
    {
        $social_areas = SocialAreas::all();
        return response()->successJson(['social_areas' => $social_areas]);
    }

    public function cities(Request $request)
    {
        $cities = City::query();
        if (!empty($request->all()['region_id'])) {
            $cities->where('region_id', $request->all()['region_id']);
        }
        $cities = $cities->get();
        return response()->successJson(['cities' => $cities]);
    }
}
