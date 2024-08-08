<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Veiculo;

class AdminController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Veiculo::all();
    }

    public function update(UpdateVehicle $request)
    {
        //
    }

    public function show()
    {
        return ['key1'=>'valor1','key2'=>'valor2'];
    }

    public function destroyer()
    {
        return ['key1'=>'valor1','key2'=>'valor2'];
    }
}
