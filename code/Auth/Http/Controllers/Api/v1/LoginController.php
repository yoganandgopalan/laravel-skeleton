<?php

namespace Code\Auth\Http\Controllers\Api\v1;

use Code\Auth\Http\Requests\LoginRequest;
use Code\Core\Http\Controllers\CoreController;
use Code\Auth\Traits\JwtAuthentication;
use Code\Core\Traits\JsonResponseTrait;

class LoginController extends CoreController
{
    use JsonResponseTrait, JwtAuthentication;

    /**
     * Handles the login process for Chef and Diner
     * @param LoginRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return $request->json([]);
    }

}