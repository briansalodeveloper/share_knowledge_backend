<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\GeneralJsonException;
use Illuminate\Http\JsonResponse;
use App\Components\AppConstant;

class LoginService
{
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Register new user
     *
     * @return array
     */
    public function registerUser()
    {
        $rtn = $this->userRepository->createUser();

        return $rtn;
    }

    /**
     * Get user details
     *
     * @return array
     */
    public function loginUser()
    {
        if (!Auth::attempt(request()->only('email', 'password'))) {  
            throw new GeneralJsonException(AppConstant::INVALID_CREDENTIALS, JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        session()->regenerate();
        session()->put('api.data.login', true);
        session()->put('api.data.customer_id', $user->id);
        session()->put('api.data.token', session()->getId());

    }

    /**
     * Logout user
     *
     * @return string
     */
    public function logoutUser()
    {
        return Auth::logout();
    }
}
