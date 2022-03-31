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
        $this->repository = new CitizenRepository;
        $this->service = new CitizenService();
    }
    public function index(Request $request)
    {
        $citizens = $this->service->getAll($request);
        return $citizens;
//        return response()->successJson(['citizens' => $citizens]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
//        dd($id);
        $citizen = $this->service->show($id);

        return $citizen;
    }

    public function update(Request $request, $id)
    {
        $citizen = $this->service->update($request, $id);

        return $citizen;
    }



}
