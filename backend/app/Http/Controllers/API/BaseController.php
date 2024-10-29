<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "sasiadwpotrzebie api", title: "Documentation about projekt SasiadWPotrzebie"),
    OA\Server(url: 'http://localhost:9000', description: "local server"),
    OA\Server(url: 'http://localhost:9000', description: "staging server"),
    OA\Server(url: 'http://localhost:9000', description: "production server"),
    OA\SecurityScheme( securityScheme: 'sanctum', type: "http", name: "Authorization", in: "header", scheme: "bearer"),
]


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $status = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $status);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
