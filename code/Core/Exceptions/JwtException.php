<?php

namespace Code\Core\Exceptions;

use Exception;
use Code\Core\Traits\JsonResponseTrait;

class JwtException extends Exception
{
    use JsonResponseTrait;

    public function report()
    {
        //Notify to Bugsnag
        //Bugsnag::notifyException($this);

        //For local copy
        \Log::critical($this);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return $this->jsonError(snake_case($this->getMessage()), $this->getCode());
    }
}