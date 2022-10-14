<?php
namespace App\Library;

use App\Exceptions\GeneralJsonException;
use App\Components\AppConstant;
use Illuminate\Http\JsonResponse;

class AppApi
{
    /**
     * check is Api Auth
     * @return bool
     * @throws AppTerminalError
     */
    public static function isApiAuth()
    {
        //* Login Check
        if (! session()->exists('api.data.login')) {
            throw new GeneralJsonException(AppConstant::UNAUTHORIZED_NO_LOGIN_SESSION, JsonResponse::HTTP_UNAUTHORIZED);
        }

        //* customer_id Check
        $customerId = session('api.data.customer_id');
        if (! $customerId) {
            throw new GeneralJsonException(AppConstant::UNAUTHORIZED_NO_CUSTOMER_ID_SESSION, JsonResponse::HTTP_UNAUTHORIZED);
        }

        return true;
    }
}