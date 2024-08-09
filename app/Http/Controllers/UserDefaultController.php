<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculo;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserDefaultController extends Controller
{
    public function index()
    {
        // User::find(23)->veiculo;
        // dd(Auth::id());
        $vehicle = User::find(Auth::id())->veiculo;
        return view('home',['vehicles'=>$vehicle]);
    }
}
