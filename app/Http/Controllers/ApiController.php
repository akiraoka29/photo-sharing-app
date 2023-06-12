<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $successMessage = 'Success.';
    /**
     * Success response method.
     *
     * @param  integer $code
     * @param  string $message
     * @param  array $data
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($code=200,$message = null,$data = [])
    {
        $response = [
            'message' => ($message) ? $message : $this->successMessage,
        ];

        if($data) $response['data'] = $data;

        return response()->json($response, $code);
    }

    /**
     * Return error response.
     *
     *
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */

    public function sendException(\Exception $exception)
    {
        $response = [
            'message' => 'Error.',
        ];

        if(ENV('APP_DEBUG')) {
            $errors = json_decode($exception->getMessage());

            $response['errors'] = $errors;
        }

        return response()->json($response, 500);
    }

}
