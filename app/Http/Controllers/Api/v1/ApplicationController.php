<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        return $request;
        $user = Auth::user();

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
            'number' => $request->number,
            'code' => $request->code,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);

        return response()->successJson(['citizen' => $application]);
    }
}
