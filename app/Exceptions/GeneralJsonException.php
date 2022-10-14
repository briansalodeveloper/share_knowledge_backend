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
        switch($this->getMessage()) {
            case(AppConstant::INVALID_CREDENTIALS):
                return new JsonResponse([
                    'unauthorized' => $this->getMessage(),
                ], $this->code);
            break;
            case(AppConstant::UNAUTHORIZED_NO_LOGIN_SESSION):
                return new JsonResponse([
                    'unauthorized' => $this->getMessage(),
                ], $this->code);
            break;
            case(AppConstant::UNAUTHORIZED_NO_CUSTOMER_ID_SESSION):
                return new JsonResponse([
                    'unauthorized' => $this->getMessage(),
                ], $this->code);
            break;
        }
    }
}
