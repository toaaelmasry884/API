<?php

namespace App\Http\Middleware;
use App\Traits\GeneralTrait;

// use App\Http\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
class CheckUserToken
{

    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
        $user =JWTAuth::parseToken()->authenticate();

        } catch(\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this-> returnError('E3001','INVALID_TOKEN');
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this-> returnError('E3001','EXPIRED_TOKEN');
            }else{
                return $this-> returnError('E3001','TOKEN_NOTFOUND');
            }
        }catch(\Throwable $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this-> returnError('E3001','INVALID_TOKEN');
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this-> returnError('E3001','EXPIRED_TOKEN');
            }else{
                return $this-> returnError('E3001','TOKEN_NOTFOUND');
            }
         
        }
        if(!$user)
            
            return $this-> returnError('E3001',trans('unauthenticated'));
        return $next($request);
    }
}
