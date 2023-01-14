<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request){
        $userData = $request->all();
        User::create([
            "name" => $userData["name"],
            "password" => Hash::make( $userData["password"] )
        ]);
    }

    public function login(Request $request){
        if( !Auth::attempt($request->only(["name","password"])) )
        {
            return response([
                "message" => "Invalid Credential"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
