<?php

namespace p2_v2\Http\Middleware;

use Closure;

class EnfermeraJefe {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->session()->has("personal")) {
            //solo necesita ser personal
            if ($request->session()->get('personal')->tipo == "ENFERMERA_JEFE") {
                return $next($request);
            }
        }
        return redirect("/logout");
    }

}
