<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Citizen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApplicationRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Application();
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAuth(){
        return Auth::user();
    }

    public function getConfirm($id){

        $application = Application::where(['id' => $id])->first();

        Application::updateOrCreate(['id' => $id],['status' => 1]);

        Citizen::create([
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'fathers_name' => $application->fathers_name,
            'birth_date' => $application->birth_date,
            'region_id' => $application->region_id,
            'city_id' => $application->city_id,
            'address' => $application->address,
            'phone' => $application->phone,
            'passport' => $application->passport,
            'tin' => $application->tin,
            'social_areas_id' => $application->social_areas_id,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);
        return response()->successJson('Reference successfully confirmed');
    }

    public function getStore($request){
        $application = Application::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fathers_name' => $request->fathers_name,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'passport' => $request->passport,
            'tin' => $request->tin,
            'social_areas_id' => $request->social_areas_id,
            'number' => 0,
            'code' => $request->code,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $application->update([
            'number' => str_pad($application->id, 6, "0", STR_PAD_LEFT),
        ]);

        return response()->successJson(['citizen' => $application]);
    }

}
