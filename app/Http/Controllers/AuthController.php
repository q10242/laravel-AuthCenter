<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function logout(Request $request){

        $user = auth('sanctum')->user();
        if ($user == null ) {
            return response()->json(["msg"=> "logged out!"]);
        }
        if (isset($request->token_name)){
            $user->tokens()->where('name', $request->token_name)->delete();
        } else {
            $user->tokens()->delete();
        }
        return response()->json(["msg"=> "logged out!", "user_id"=> $user->id]);
    }
}
