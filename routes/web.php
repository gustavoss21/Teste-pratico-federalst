<?php
use Illuminate\Http\Request;
use App\Http\Middleware\GenerateToken;
use App\Http\Middleware\PermissionAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', function(Request $request){
//     return view('index');
// })->name('home');
Route::group(['middleware' => ['auth']],function(){
    Route::get('/home','UserDefaultController@index')->name('home');
    Route::get('/get-veiculos','UserDefaultController@getVehicles')->name('getVehicles');
});

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function () {
        // Authentication Rotes
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this::post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        //Password Reset
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::group(['middleware' => PermissionAdmin::class], function(){
                    // CRUD
            Route::get('/get-veiculos', 'AdminController@getVehicles')->name('vehicle.getVehicles');
            Route::get('/home', 'AdminController@index')->name('vehicle.index');
            Route::get('/home/veiculo/adicionar', 'AdminController@show_create')->name('vehicle.show_create');
            Route::post('/home/veiculo/adicionar', 'AdminController@create')->name('vehicle.create');
            Route::get('/home/veiculo/{veiculo}', 'AdminController@show')->name('vehicle.show');
            Route::get('/home/veiculo/atualizar/{veiculo}', 'AdminController@show_update')->name('vehicle.show_update');
            Route::put('/home/veiculo/atualizar/{veiculo}', 'AdminController@update')->name('vehicle.update');
            Route::get('/home/veiculo/delete/{id}', 'AdminController@delete')->name('vehicle.delete');
        });
    }
);

