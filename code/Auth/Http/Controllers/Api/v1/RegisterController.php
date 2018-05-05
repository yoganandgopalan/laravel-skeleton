<?php

namespace Code\Auth\Http\Controllers\Api\v1;

use Code\Core\Exceptions\CoreException;
use Code\Core\Http\Controllers\CoreController;
use Code\Core\Traits\JsonResponseTrait;
use Code\Auth\Http\Requests\RegistrationRequest;

class RegisterController extends CoreController
{
    use JsonResponseTrait;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Handles the registration process for Chef and Diner
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RegistrationRequest $request): \Illuminate\Http\JsonResponse
    {
        dd("Write some logic");
    }
}