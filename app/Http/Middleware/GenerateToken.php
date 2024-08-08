<?php

namespace App\Http\Middleware;

use Closure;

class GenerateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if($request->isMethod('post')){
        //     if($request->path() == 'login'){
        //         $credencias = $request->all(['email','password']);
        //         $token = auth('api')->attempt($credencias);
        //         setcookie("token", $token);
        //         // dd($token);
        //     }
        // }

        return $next($request);

    }
}
