<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request("email"), 'password' => request('password')])){
                $user = Auth::user();
            $success["token"] = $user->createToken('Utoken')->accessToken;
            return response()->json( $success);
         }else{

            return response()->json(["error" => "Unauthorized", 401]);
        }
    }
}
