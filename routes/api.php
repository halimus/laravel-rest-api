<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//})

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->get('/', function () {
        return view('api');
    });
    
    $api->get('users', 'App\Http\Controllers\Api\UsersController@index');
    $api->get('users/{id}', 'App\Http\Controllers\Api\UsersController@show');
    
    

    
});



