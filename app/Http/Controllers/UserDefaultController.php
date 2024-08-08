<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculo;
use Illuminate\Support\Facades\Auth;

class UserDefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission.admin');
    }
    public function index()
    {
        // User::find(23)->veiculo;
        dd(Auth::id());
        dd(User::find(Auth::id())->veiculo);
        return ['tes'=>'valor'];
    }
}
