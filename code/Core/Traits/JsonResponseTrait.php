<?php

namespace Code\Core\Traits;


trait JsonResponseTrait
{
    public function jsonError($message, $status = 404){
        return response()->json(["error" => true, "data" => null, "message" => $message], $status);
    }

    public function jsonSuccess($data){
        return response()->json(["error" => false, "data" => $data, "message" => null], 200);
    }
}