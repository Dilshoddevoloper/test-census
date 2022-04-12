<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Citizen;
use App\Models\Roles;
use App\Repositories\ApplicationRepository;
use App\Repositories\CitizenRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ApplicationRepository();
    }

    public function getAll(Request $request)
    {
        $user = $this->repository->getAuth();
        $query = $this->repository->getQuery();

        $query->with('region:id,name_cyrl')
            ->with('city')
            ->with('social_areas');

        if ($user->role_id == Roles::REGION_ID){
            $query->where(['region_id' => $user->region_id]);
        }
        if ($user->role_id == Roles::CITY_ID){
            $query->where(['city_id' => $user->city_id]);
        }

        if (!empty($request->all()['region_id'])){
            $query->where(['region_id' => $request->all()['region_id']]);
        }
        if (!empty($request->all()['city_id'])){
            $query->where(['city_id' => $request->all()['city_id']]);
        }
        if (!empty($request->all()['social_areas_id'])){
            $query->where(['social_areas_id' => $request->all()['social_areas_id']]);
        }
        if (!empty($request->all()['status'])){
            $query->where(['status' => $request->all()['status']]);
        }
        else{
            $query->where(['status' => 0]);
        }
        if (!empty($request->all()['last_name'])){
            $query->where('applications.last_name', 'like', '%'. $request->all()['last_name'].'%');
        }
        if (!empty($request->all()['first_name'])){
            $query->where('applications.first_name', 'like', '%'. $request->all()['first_name'].'%');
        }
        if (!empty($request->all()['fathers_name'])){
            $query->where('applications.fathers_name', 'like', '%'. $request->all()['fathers_name'].'%');
        }
        if (!empty($request->all()['passport'])){
            $query->where('applications.passport', 'like', '%'. $request->all()['passport'].'%');
        }

        return $query->paginate(30);
        return [
            'current_page' => $request->page ?? 1,
            'per_page' => $request->limit,
            'data' =>$query->get(),
            'total' => $query->count() < $request->limit ? $query->count() : -1
        ];


    }

    public function getConfirm($id){

        return $this->repository->getConfirm($id);
    }

    public function getShow($id) {
        $application = Application::where(['id' => $id])
            ->with('region:id,name_cyrl')
            ->with('city')
            ->with('social_areas')
            ->with('applicationDenyReason')
            ->first();

        return response()->successJson(['application' => $application]);
    }

    public function update($request){
        $id = $request->all()['id'];
        $deny_reason = $request->all()['deny_reason'];
        $deny_reason_id = $request->all()['deny_reason_id'];

        Application::updateOrCreate(['id' => $id],['status' => 2, 'deny_reason' => $deny_reason, 'deny_reason_id' => $deny_reason_id]);

        return response()->successJson('Reference successfully modified');

    }

    public function checkStatusApplication($request)
    {
        $application = Application::query()
            ->where('number', $request['number'])
            ->where('code', $request['code'])
            ->with('applicationDenyReason')
            ->withoutGlobalScopes()
            ->select('id','first_name','last_name','status',
                'deny_reason','region_id','city_id' ,'deny_reason_id')
            ->first();
        if ($application) {
            $application->region;
            $application->city;
            $application->applicationDenyReason;
            $application->user_city = $application->user_city;
        }

        return $application;
    }

    public function getStore($request){

        return $this->repository->getStore($request);
    }



}
