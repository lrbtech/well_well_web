<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthKey
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
        // $token = $request->header('APP_KEY');
        // if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
        //     return response()->json(['message' => 'App Key Not Found'], 401);
        // }
        return $next($request);
    }
}
