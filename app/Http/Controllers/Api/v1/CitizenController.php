<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\City;
use App\Services\CitizenService;
use App\Models\Citizen;
//use App\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CitizenRepository;

class CitizenController extends Controller
{
    public $modelClass;
    private $repo;
    private $service;
    protected $response;
    public function __construct()
    {
        $this->modelClass = new Citizen;
        $this->repo = new CitizenRepository;
        $this->service = new CitizenService();
    }
    public function index(Request $request)
    {
        $citizens = $this->service->getAll($request);

        return response()->successJson(['citizens' => $citizens]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        $citizen = $this->service->show($id);
        $this->response['result'] = ['citizen' => $citizen ];
        return response()->json($this->response);
    }

    public function update(Request $request, $id)
    {

        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function  getPassport(Request $request){
        if(!empty($request->passport) && !empty($request->tin)) {
            $data = $this->service->getPassport($request->passport, $request->tin);
//            return $data;
            $user = $this->repo->getAuth();
            $citizen = [
                'last_name' => $data['result']['surname_latin'],
                "first_name" => $data['result']['name_latin'],
                "fathers_name" => $data['result']['patronym_latin'],
                "birth_date" => date('d.m.Y', strtotime($data['result']['birth_date'])),
                'region_id' => $user->region_id,
                'city_id' => $user->id,
                "address" => $data['result']['birth_place'],
                "passport" => $data['result']['document'],
                "id" => null
            ];

        }

        return ['status' => 200, 'citizen' => $citizen];
    }

//    /**
//     * restore specific post
//     *
//     * @return void
//     */
//    public function restore($id)  //bu softdelete  uchun ishlatiladi, bizga kerak bo'lmagani uchun o'chirilgan
//    {
//        Citizen::withTrashed()->find($id)->restore();
//        $this->response['success'] = true;
//        return response()->json($this->response);
//    }

//    /**
//     * restore all post
//     *
//     * @return response()
//     */
//    public function restoreAll() //bu softdelete  uchun ishlatiladi, bizga kerak bo'lmagani uchun o'chirilgan
//    {
//        Citizen::onlyTrashed()->restore();
//        $this->response['success'] = true;
//        return response()->json($this->response);
//    }



}
