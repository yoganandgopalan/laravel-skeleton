<?php

namespace Code\Auth\Traits;

use Code\Core\Exceptions\JwtException;
use Firebase\JWT\JWT;
use Exception;

//Jwt authentication mechanism using FireBase-JWT
trait JwtAuthentication
{
    /**
     * @param $user
     * @return string
     */
    public function generateToken($user): string
    {
        $payload = [
            'sub'   => $user,
            'iat'   => time(),
            'exp'   => time() + 60*60 //1 hour validity
        ];
        return JWT::encode($payload, config('app.key')); // Change to jwt_secret
    }

    /**
     * @param $token
     * @return \stdClass
     * @throws JwtException
     */
    public function decodeToken(string $token): \stdClass
    {
        try {
            $token = JWT::decode($token, config('app.key'), ['HS256']);
            return $token;
        } catch(Exception $e) {
            throw new JwtException($e->getMessage(), 401);
        }
    }

}