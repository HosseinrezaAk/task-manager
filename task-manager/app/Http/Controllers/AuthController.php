<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $userData = $request->all();
        $user = new User;
        $user->username = $userData["username"];
        $user->email = $userData["email"];
        $user->password = Hash::make($userData["password"]);
        $user->save();
        return $user;
    }

    public function login(Request $request){

        if( !Auth::attempt($request->only("email","password")) ){
            return response([
                'message' => "invalid Credential"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $userData = $request->all();
        $user= User::query()->where("email",$userData["email"])->first();


        $token = auth()->attempt($userData);
        $user = auth()->user();

        return ($token);
    }
}
