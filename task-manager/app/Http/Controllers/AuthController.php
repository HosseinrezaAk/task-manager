<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request){
        $userData = $request->all();
        User::create([
            "name" => $userData["name"],
            "password" => Hash::make( $userData["password"] )
        ]);
    }
}
