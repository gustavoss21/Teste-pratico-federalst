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

Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    // Route::get('/veiculo','UserDefaultController@index');
    Route::post('/refresh','Auth\LoginController@refresh');
    Route::post('/logout','Auth\LoginController@logout');
});


Route::prefix('admin')->middleware('admin.permission')->group(function(){
    Route::get('/veiculo','AdminController@index');
});

Route::middleware('generate_token','auth:api')->get('/user', function (Request $request) {
    // return $request->user();
});


Route::post('/login','Auth\LoginController@login');