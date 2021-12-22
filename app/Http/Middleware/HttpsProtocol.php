<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HttpsProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        if (!$request->secure() && App::environment() === 'production') {
            $url = 'https://surigaodelsur.ph' . $request->getRequestUri();
            return redirect()->to($url);
        }

        return $next($request);
    }
}
