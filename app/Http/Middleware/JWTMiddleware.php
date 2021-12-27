<?php

namespace App\Http\Middleware;

use App\Traits\APIResponseTrait;
use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{
    use APIResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->generateAPIResponse(false, [], ['Invalid token'], 401);
            }

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->generateAPIResponse(false, [], ['Toke expired'], 401);
            }

            return $this->generateAPIResponse(false, [], ['Authorization Token not found'], 401);
        }
        return $next($request);
    }
}
