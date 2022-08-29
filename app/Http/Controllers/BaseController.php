<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Success response method
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200) {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Error response method
     *
     * @return \Illuminate\Http\Response
     */
    public function  sendError($error, $errorMessage = [], $code = 400) {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
