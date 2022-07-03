<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse($message = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $message, 'data' => $data], 200);
    }

    protected function errorResponse($errorMessage = null, $message = null)
    {
        return response()->json(['status' => false, 'message' => $errorMessage, 'errors' => $message], 200);
    }

    protected function successResponseM($message = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $message, 'data' => $data], 200);
    }

    protected function errorResponseM($errorMessage = null, $message = null)
    {
        return response()->json(['status' => false, 'message' => $errorMessage, 'errors' => $message], 200);
    }

}
