<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $statusCode;
    protected $message;
    protected $data;



    public function __construct($statusCode, $message,$data)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->data = $data;

    }

    public function render()
    {
        return response()->json(['status'=>'false','message' => $this->message,'data'=>$this->data], $this->statusCode);
    }
}
