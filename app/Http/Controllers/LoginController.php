<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function register(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response([
                'message' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED );
        }
        
        $user = Auth::user();
       
        $token = $user->createToken("$user->name api_token")->plainTextToken;
        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'emai' => $user->email,
            'token' => $token,
        ];
        return $response;
    }

    public function logout()
    {
        return "Successfully logout";
    }
}
