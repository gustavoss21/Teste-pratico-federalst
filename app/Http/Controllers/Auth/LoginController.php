<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Defini para onde devo redirecionar o usuario autenticado.
     * @return string
     */
    public function redirectTo()
    {
        return \Auth::user()->role == User::ROLE_ADMIN ? '/admin/home' : 'home';
    }

    public function login(Request $request)
    {
                //         $credencias = $request->all(['email','password']);
        //         $token = auth('api')->attempt($credencias);
        //         setcookie("token", $token);
        $credencias = $request->all(['email','password']);

        $token = Auth('api')->attempt($credencias);
        if($token){
            dd(Auth::user());//Auth::user()->role != User::ROLE_ADMIN
            return response()->json(['token'=>$token]);
        }else{
            return response()->json(['token'=>$token]);
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
         
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Auth('api')->logout();
        return redirect($request->is('admin/*') ? '/admin/login' : '/login');

    }

    public function refresh(){
        $token = Auth('api')->refresh();
        return response()->json(Auth()->user());
    }

}
