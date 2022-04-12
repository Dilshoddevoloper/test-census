<?php

namespace App\Services;

use App\Models\Citizen;
use App\Repositories\CitizenRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;


class CitizenService
{

    const RESOURCE_URL = 'https://resource1.mehnat.uz/services';

    /**
     * @var CitizenRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new CitizenRepository();
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
        if (!empty($request->all()['last_name'])){
            $query->where('citizens.last_name', 'like', '%'. $request->all()['last_name'].'%');
        }
        if (!empty($request->all()['first_name'])){
            $query->where('citizens.first_name', 'like', '%'. $request->all()['first_name'].'%');
        }
        if (!empty($request->all()['fathers_name'])){
            $query->where('citizens.fathers_name', 'like', '%'. $request->all()['fathers_name'].'%');
        }
        if (!empty($request->all()['passport'])){
            $query->where('citizens.passport', 'like', '%'. $request->all()['passport'].'%');
        }

//        $citizens = $query->paginate(2)->toArray();
//
//        unset($citizens['first_page_url']);
//        unset($citizens['last_page_url']);
//        unset($citizens['next_page_url']);
//        unset($citizens['prev_page_url']);
//        unset($citizens['path']);
//        return $citizens;

        return $query->paginate(30);
//        return [
//            'current_page' => $request->page ?? 1,
//            'per_page' => $request->limit,
//            'data' =>$query->get(),
//            'total' => $query->count() < $request->limit ? $query->count() : -1
//        ];


    }

    public function store($request)
    {
        $user = Auth::user();

        $validator = $this->repository->toValidate($request->all());
        $msg = "";

        if (!$validator->fails()){


            if ($user->role_id == Roles::ADMIN_ID){
                return response()->errorJson('Рухсат мавжуд емас', 101);
            }
            if ($user->role_id == Roles::REGION_ID){
                return response()->errorJson('Рухсат мавжуд емас', 101);
            }
            if ($user->role_id == Roles::CITY_ID){
                $citizen = $this->repository->store($request);
                return response()->successJson(['citizen' => $citizen]);
            }
        }
        else{
            $errors = $validator->failed();
            if(empty($errors)) {
                $msg = "Соҳалар нотўғри киритилди";
            }
            return response()->errorJson($msg, 400, $errors);
        }


    }

    public function show($id)
    {
        $user = Auth::user();
        $query = Citizen::query();
        $query->where(['id' => $id])
            ->with('region:id,name_cyrl')
            ->with('city')
            ->with('social_areas:id,name_cyrl');;

        if (empty($query->first())){
            return response()->errorJson('Бундай ид ли фойдаланувчи мавжуд емас', 409);
        }
        if ($user->role_id == Roles::ADMIN_ID){
            return $query->first();
        }
        if ($user->role_id == Roles::REGION_ID){
            $query->where(['region_id' => $user->region_id]);
            if (empty($query->first())){
                return response()->errorJson('Рухсат мавжуд емас', 101);
            }
            return $query->first();
        }
        if ($user->role_id == Roles::CITY_ID){
            $query->where(['city_id' => $user->city_id]);
            if (empty($query->first())){
                return response()->errorJson('Рухсат мавжуд емас', 101);
            }
            return $query->first();
        }
    }

    public function update($request, $id){
        $msg = "";
        $validator = $this->repository->toValidate($request->all());

        if (!$validator->fails()) {
                $citizen = $this->repository->update($request, $id);
            $result =  ['status' => 200, 'citizen' => $citizen];
        } else {
            $errors = $validator->failed();
            if(empty($errors)) {
                $msg = "Соҳалар нотўғри киритилди";
            }
            $result = ['msg' => $msg, 'status' => 422, 'error' => $errors];
        }

        if($result['status'] == 409) {
            return response()->errorJson($result['msg'], 200, [], [], 'db');
        }
        if($result['status'] == 422) {
            return response()->errorJson($result['msg'], 200, $result['error'], [], 'db');
        }
        return response()->successJson($result['citizen']);
    }

    public function destroy($id){
        $citizen = $this->repository->getById($id);

        if ($citizen) {
            $citizen->delete();
            $this->response['success'] = true;
        } else {
            $this->response['success'] = false;
            $this->response['error'] = "Citizen not found";
        }
        return response()->json($this->response);
    }

    public function getPassport($passport, $tin){
        $client = new Client(['verify' => false]);
        $data = [
            'version' => '1.0',
            'id' => 7436,
            'method' => 'ips.person',
            'params' => [
                'passport' => $passport,
                'pin' => $tin
            ]
        ];
        try {
            $response = $client->post(self::RESOURCE_URL, [
                'json' => $data
            ]);

            return json_decode((string)$response->getBody(), true);
        } catch (RequestException   $e) {
            return null;
        } catch (ConnectException    $e) {
            return null;
        }
    }



}
