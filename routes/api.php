<?php

namespace App\routes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
    Route::middleware(['auth:api'])->group(function () {
        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'citizens'], function () {
                Route::get('/', 'Api\v1\CitizenController@index');
                Route::post('/store', 'Api\v1\CitizenController@store');
                Route::get('/show/{id}', 'Api\v1\CitizenController@show');
                Route::put('/update/{id}', 'Api\v1\CitizenController@update');
                Route::delete('/destroy/{id}', 'Api\v1\CitizenController@destroy');
            });
            Route::group(['prefix' => 'resources'], function () {
                Route::get('regions', 'Api\v1\ResourceController@regions');
                Route::get('social_areas', 'Api\v1\ResourceController@social_areas');
                Route::get('cities', 'Api\v1\ResourceController@cities');
            });

            Route::get('report', 'ReportController@report');
        });

    });
