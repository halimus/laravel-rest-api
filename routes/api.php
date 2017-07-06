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
    
    $api->get('/docs', function () {
        return view('vendor.l5-swagger.index');
    });
    
    /**
     * Users routes
     */
    $api->get('users', 'App\Http\Controllers\Api\UsersController@index');
    $api->get('users/{id}', 'App\Http\Controllers\Api\UsersController@show');
    $api->post('users/create', 'App\Http\Controllers\Api\UsersController@store');
    $api->put('users/{id}', 'App\Http\Controllers\Api\UsersController@update');  
    $api->delete('users/{id}', 'App\Http\Controllers\Api\UsersController@destroy'); 
    
    /**
     * Languages routes
     */
    $api->get('language', 'App\Http\Controllers\Api\LanguagesController@index');
    $api->get('language/{id}', 'App\Http\Controllers\Api\LanguagesController@show');
    $api->post('language/create', 'App\Http\Controllers\Api\LanguagesController@store');
    $api->put('language/{id}', 'App\Http\Controllers\Api\LanguagesController@update');  
    $api->delete('language/{id}', 'App\Http\Controllers\Api\LanguagesController@destroy'); 
    
    /**
     * Author routes
     */
    $api->get('author', 'App\Http\Controllers\Api\AuthorController@index');
    $api->get('author/{id}', 'App\Http\Controllers\Api\AuthorController@show');
    $api->post('author/create', 'App\Http\Controllers\Api\AuthorController@store');
    $api->put('author/{id}', 'App\Http\Controllers\Api\AuthorController@update');  
    $api->delete('author/{id}', 'App\Http\Controllers\Api\AuthorController@destroy'); 
    
    /**
     * Book routes
     */
    $api->get('book', 'App\Http\Controllers\Api\BookController@index');
    $api->get('book/{id}', 'App\Http\Controllers\Api\BookController@show');
    $api->post('book/create', 'App\Http\Controllers\Api\BookController@store');
    $api->put('book/{id}', 'App\Http\Controllers\Api\BookController@update');  
    $api->delete('book/{id}', 'App\Http\Controllers\Api\BookController@destroy'); 
    
    
    /**
     * Author/Language has Books routes
     */
    $api->get('author/{id}/book', 'App\Http\Controllers\Api\AuthorBookController@index');
    $api->get('language/{id}/book', 'App\Http\Controllers\Api\LanguageBookController@index');
    
    
});



