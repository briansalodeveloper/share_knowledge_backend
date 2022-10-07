<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Services\LoginService;

class LoginController extends Controller
{

    public function __construct(
        LoginService $loginService
    ) {
        $this->loginService = $loginService;
    }

    /**
     * register new user
     *
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $rtn = $this->loginService->registerUser();
        return $rtn;
    }

    /**
     * log in user
     *
     * @param LoginRequest $request
     * @throws \App\Exceptions\GeneralJsonException
     */
    public function login(LoginRequest $request)
    {
        $rtn = $this->loginService->loginUser();

        return response()->json([
            'token' => session('api.data.token'),
        ]);
    }

    /**
     * logout user
     *
     */    
    public function logout($id)
    {
        $rtn = $this->loginService->logoutUser();
        return $rtn;

    }


}
