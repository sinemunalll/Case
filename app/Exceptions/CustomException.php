<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message;
    protected $status;
    protected $errors;

    public function __construct($message, $status = 404, $errors = [])
    {
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request)
    {
        if($request->getContentType()=='xml'){
            return response()->view('soapfault', ['code'=>$this->message, 'messages'=>$this->errors], 200, ['Content-Type'=>'text/xml']);
        }

        $response=[
            'success'=>false,
            'message'=>$this->message,
        ];

        return response()->json($response);
    }

    /**
     * @return array|mixed
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
