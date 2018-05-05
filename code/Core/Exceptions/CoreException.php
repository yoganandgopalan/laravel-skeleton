<?php

namespace Code\Core\Exceptions;

use Exception;
use Code\Core\Traits\JsonResponseTrait;
use Bugsnag;

class CoreException extends Exception{

    use JsonResponseTrait;


    public function report()
    {
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
        if($request->wantsJson() || $request->ajax()){
            return $this->jsonError($this->getMessage(), $this->getCode());
        }

        return parent::render($request, $this->getTraceAsString());
    }

}