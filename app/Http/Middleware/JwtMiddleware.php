<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
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
        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e){
            if($e instanceof TokenInvalidException){
                return response("Token is Invalid", 401);
            } else if($e instanceof TokenExpiredException){
                return response("Token is Expired.", 401);
            } else {
                return response("Token not found.", 401);
            }
        }
        
        return $next($request);
    }
}
