<?php


namespace App\Repositories;


use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Citizen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CitizenRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Citizen;
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        $user = Auth::user();

        $citizen = $this->model::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fathers_name' => $request->fathers_name,
            'birth_date' => $request->birth_date,
            'region_id' => $user->region_id,
            'city_id' => $user->city_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'passport' => $request->passport,
            'tin' => $request->tin,
            'social_areas_id' => $request->social_areas_id,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);


        $data['citizen']=$citizen;
        return $data;
    }

    public function getAuth(){
        return Auth::user();
    }

    public function update($request, $id)
    {
        $user = $this->guard()->user();
        $citizen  = Citizen::find($id);
//        $citizen = $this->getById($id);

        $citizen->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fathers_name' => $request->fathers_name,
            'birth_date' => $request->birth_date,
            'region_id' => $user->region_id,
            'social_areas_id' => $request->social_areas_id,
            'city_id' => $user->city_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'passport' => $request->passport,
            'tin' => $request->tin,
            'updated_at' => Carbon::now()->format('Y-m-d'),
        ]);



        $data['citizen']=$citizen;

        return $data;
    }

    public function toValidate($array, $status = null)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'fathers_name' => 'required',
            'birth_date' => 'required',
            'region_id' => 'nullable',
            'city_id' => 'nullable',
            'address' => 'required',
            'phone' => 'required',
            'passport' => 'required',
            'tin' => 'required',
            'remember_token' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',

        ];
        $validator = Validator::make($array, $rules);
        return $validator;
    }

    public function updateOrCreate($attributes)
    {
        return Citizen::updateOrCreate(
            [
                'pin' => $attributes['pin']
            ],
            [
                'passport' => $attributes['passport'],
                'surname' => $attributes['surname'],
                'firstname' => $attributes['firstname'],
                'patronymic' => $attributes['patronymic'],
                'birth_date' => $attributes['birth_date'],
                'gender' => $attributes['gender'],
                'living_place' => $attributes['living_place'],
                'age' => $attributes['age'],
                'region_id' => $attributes['region_id'],
                'city_id' => $attributes['city_id'],
                'city_sector' => $attributes['city_sector'],
                'makhalla_id' => $attributes['makhalla_id'],
            ]
        );
    }
}
