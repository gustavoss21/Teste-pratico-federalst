<?php
use Illuminate\Http\Request;
use App\Http\Middleware\GenerateToken;
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

    // CRUD
    Route::get('/home', 'AdminController@index')->name('veiculo.index');
    Route::get('/home/veiculo/adicionar', 'AdminController@show_create')->name('veiculo.show_create');
    Route::post('/home/veiculo/adicionar', 'AdminController@create')->name('veiculo.create');
    Route::get('/home/veiculo', 'AdminController@show')->name('veiculo.show');
    Route::get('/home/veiculo/update/{veiculo}', 'AdminController@show_update')->name('veiculo.show_update');
    Route::put('/home/veiculo/update', 'AdminController@update')->name('veiculo.update');
    Route::get('/home/veiculo/delete/{id}', 'AdminController@delete')->name('veiculo.delete');
});
