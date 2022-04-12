<?php

namespace App\Services;

use App\Models\ApplicationDenyReason;
use App\Repositories\ApplicationDenyReasonsRepository;

class ApplicationDenyReasonsService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ApplicationDenyReasonsRepository();
    }

    public function getAll(){
       return ApplicationDenyReason::all();
    }

}
