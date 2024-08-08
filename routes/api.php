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

Route::middleware('generate_token','auth:api')->get('/user', function (Request $request) {
    // return $request->user();
});


Route::prefix("/veiculo")->middleware(['jwt.auth'])->group(function() {
    Route::get('/','UserDefaultController@index');
});
