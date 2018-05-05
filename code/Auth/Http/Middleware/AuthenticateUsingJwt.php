<?php

namespace Code\Auth\Http\Middleware;

use Closure;
use Code\Auth\Traits\JwtAuthentication;
use Code\Core\Exceptions\JwtException;
use Code\Core\Traits\JsonResponseTrait;

class AuthenticateUsingJwt
{
    use JwtAuthentication, JsonResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws JwtException
     */
    public function handle($request, Closure $next)
    {
        if(is_null(request()->header('Authorization'))){
            return $this->jsonError("Login required", 401);
        }

        preg_match('/Bearer\s(\S+)/', request()->header('Authorization'), $matches);

        if (count($matches) === 0){
            throw new JwtException("Token not found.", 401);
        }

        $token = $this->decodeToken(trim($matches[1]));

        //This may not be needed
        if(!isset($token->sub) || !isset($token->sub->user) || !isset($token->sub->type)){
            throw new JwtException("Token tampering", 401);
        }

        //Retrieve id and type and then login once for stateless
        $user = \Crypt::decryptString($token->sub->user); //Returns an array. Pluck first element itself
        $type = \Crypt::decryptString($token->sub->type); //Decrypt type

        //Login the user for the current request only so that $request->user('guard') and Auth::user() can be made use
        //\Auth::guard('api-user1')->usingId($user);
        //Set the default guard
        //\Auth::shouldUse('api-user1');

        return $next($request);
    }
}
