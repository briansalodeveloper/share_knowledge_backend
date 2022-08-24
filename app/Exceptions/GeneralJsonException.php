<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Components\AppConstant;

class GeneralJsonException extends Exception
{
    //report the exception
    public function report()
    {

    }
    //render the exception as an http response
    public function render($request)
    {
        if($this->getMessage() == AppConstant::INVALID_CREDENTIALS) {
            return new JsonResponse([
                    'unauthorized' => $this->getMessage(),
            ], $this->code);
        }
    }
}
