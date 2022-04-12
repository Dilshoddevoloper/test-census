<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Region\IndexRequest as RegionRequest;
use App\Http\Requests\City\IndexRequest as CityRequest;
use App\Models\ApplicationDenyReason;
use App\PhoneCode;
use App\Region;
use App\Services\ApplicationDenyReasonsService;
use App\Services\CityService;
use App\Services\RegionService;
use App\SocialAreas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    private $regionService;
    private $cityService;
    private $denyReasonsService;

    public function __construct(RegionService $regionService, CityService $cityService, ApplicationDenyReasonsService $denyReasonsService)
    {
        $this->regionService = $regionService;
        $this->cityService = $cityService;
        $this->denyReasonsService = $denyReasonsService;
    }

    public function regions(Region $region)
    {
        $regions = $this->regionService->getAll();
        return response()->successJson(['regions' => $regions]);
    }

    public function social_areas(SocialAreas $social_areas)
    {
        $social_areas = $this->cityService->getAll();
        return response()->successJson(['social_areas' => $social_areas]);
    }

    public function denyReasons(ApplicationDenyReason $denyReasons)
    {
        $denyReasons = $this->denyReasonsService->getAll();
        return response()->successJson(['denyReasons' => $denyReasons]);
    }

    public function cities(Request $request)
    {

        $cities = $this->cityService->getQuery();
        if (!empty($request->all()['region_id'])) {
            $cities->where('region_id', $request->all()['region_id']);
        }
        $cities = $cities->get();
        return response()->successJson(['cities' => $cities]);
    }

    public function getCode($phone = null)
    {
        $code = rand(11111, 99999);
        PhoneCode::updateOrCreate(['phone' => $phone],['code' => $code]);
        $message = 'Ushbu kod sizga bazani test qilish uchun yuborildi: ' . $code;

        $details = SmsController::send($phone, $message);


        if (!$details['result']['success']) {
            return response()->json([
                "success" => false,
                "data" => [],
                "message" => "Смс жунатилмади"
            ], 200);
        } else {
            return response()->json([
                "success" => true,
                "data" => ['code' => $code],
                "message" => "SMS created and sent successfully"
            ], 200);
        }
    }

    public function confirmSms(Request $request)
    {
        $attibutes = $request->all();

        $validator = Validator::make($attibutes, [
            'phone' => 'required',
            'code' => 'required|max:5'
        ]);

        if ($validator->fails()) {
            return response()->errorJson('Code does not match', 422);
        }
        $phone_code = PhoneCode::where(['phone' => $attibutes['phone'], 'code' => $attibutes['code']])->first();

        if($phone_code) {
            $phone_code->delete();
                return response()->successJson('Success!, Code match');
        } else {
            return response()->errorJson('Code does not match',422);
        }
    }


}
