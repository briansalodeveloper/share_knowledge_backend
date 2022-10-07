<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class FacebookSocialiteController extends Controller
{
    private $stateSession;

    /**
     * redirect to facebook login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToFB()
    {
        $url = Socialite::driver('facebook')->redirect()->getTargetUrl();
        
        return response()->json([
            'url' => $url,
        ]);

    }
       
    /**
     * get the details of the user that provided by facebook, after passing the authentication in facebook 
     *
     * @param generated-code-from-facebook $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $finduser = User::where('social_id', $user->id)->first();

        if(!$finduser){
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id'=> $user->id,
                'social_type'=> 'facebook',
                'password' => encrypt('my-facebook')
            ]);
        }

        $customer_id = $finduser?$finduser->id:$newUser->id;
        session()->regenerate();
        session()->put('api.data.token', session()->getId());
        session()->put('api.data.login', true);
        session()->put('api.data.customer_id', $customer_id);
        
        return response()->json([
            'token' => session()->all(),
        ]);
    }
}
