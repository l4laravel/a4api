<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:api")->except('login','register');
    }

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

    public function register()
    {
        request()->all();
        $validator = Validator::make(request()->all(),[
           'name' => 'required',
           'email' => 'required',
           'password' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $input = request()->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('myToken')->accessToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;

        return response()->json(['success' => $success], 200);



    }

    public function UserInfo()
    {
        return response()->json(['user' => Auth::user()]);
    }

}
