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
        $token = $user->createToken("$user->name api_token")->plainTextToken;

        $rtn = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token,
        ];

        return $rtn;
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
