<?php
 
namespace App\Http\Responses;
 
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;   
class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $returnUrl = route('home');
        if (null != $request->token_name) {
            $user = Auth::user();
            $token = $user->createToken($request->token_name)->accessToken->token;
            if (null != $request->redirect) {
                $returnUrl = urldecode($request->redirect).'?token='.$token;             
            }
        }
        return redirect($returnUrl);
    }
}