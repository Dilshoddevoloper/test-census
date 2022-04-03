<?php
namespace App\Http\Controllers\Api\v1;

use App\Services\CitizenService;
use App\Citizen;
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
//        $this->middleware('logs', ['only' => ['show', 'passport', 'passportDataFromBase']]);
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
        $this->response['result'] = [
            'citizen' => $citizen
        ];
        return response()->json($this->response);
    }

    public function update(Request $request, $id)
    {

        $result = $this->service->update($request, $id);
        if($result['status'] == 409) {
            return response()->errorJson($result['msg'], 200, [], [], 'db');
        }
        if($result['status'] == 422) {
            return response()->errorJson($result['msg'], 200, $result['error'], [], 'db');
        }
        return response()->successJson($result['citizen']);
    }


//    public function update(Request $request, $id)
//    {
//        $citizen = $this->service->update($request, $id);
//
//        return $citizen;
//    }

    public function destroy($id)
    {
        $citizen = $this->repo->getById($id);
        if ($citizen) {
            $citizen->delete();
            $this->response['success'] = true;
        } else {
            $this->response['success'] = false;
            $this->response['error'] = "Citizen not found";
        }
        return response()->json($this->response);
    }



}
