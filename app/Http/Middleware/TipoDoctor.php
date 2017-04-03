<?php

namespace p2_v2\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TipoDoctor
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
        if(Session::has("personal")){
            if(Session::get("personal")->tipo == "DOCTOR"){
                return $next($request);
            }
        }
        return $next($request);
        return redirect("/");
    }
}
