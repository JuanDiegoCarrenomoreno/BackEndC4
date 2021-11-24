<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserApiController extends Controller
{
    //
    public function login(Request $request) {
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            $user_login_token= auth()->user()->createToken('MyApp')->accessToken;
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            return response()->json(['error' => 'Acceso No Autorizado'], 401);
        }
    }

    public function registro(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No se puede crear el usuario'], 401);
        }
        $user= User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $access_token_example = $user->createToken('MyApp')->accessToken;
        return response()->json(['token'=>$access_token_example],200);
    }

}
