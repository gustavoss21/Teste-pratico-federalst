<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserDefaultController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getVehicles(){
        $vehicle = Cache::remember('user'.Auth::id().'vehicle',60, function () {
            return  User::find(Auth::id())->veiculo;
        });

        return $vehicle;
    }
}
