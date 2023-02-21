<?php

namespace App\Traits;

trait ResponseTrait
{
    public function respondSuccess($data){
        return response()->json([
            'result' => 'success',
            'data' => $data
        ], 200);
    }
    public function respondError($message, $statusCode = 404){
        return response()->json([
            'result' => 'error',
            'message' => $message
        ], $statusCode);
    }
}
