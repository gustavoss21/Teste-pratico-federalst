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
        $user_id = Auth::id();
        $vehicle_list = User::find($user_id)->veiculo;
        return $vehicle_list;
    }
}
