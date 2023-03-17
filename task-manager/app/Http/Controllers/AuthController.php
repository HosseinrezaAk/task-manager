<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login","register"]]);
    }


    public function register(Request $request)
    {
        $credentials = $request->only("username", "password");
        $validator = Validator::make($request->all(), [
            "username" => "required|string|max:255",
            "password" => "required|string|min:6",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            "username" => $request->username,
            "password" => bcrypt($request->password),
        ]);

        $token = $this->guard()->attempt($credentials);

        return response()->json([
            "token" => $token,
            "user" => $user
        ]);
    }


    /**
     * Get a JWT token via given credentials.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only("username", "password");
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(["error" => "Unauthorized"], 401);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(["message" => "Successfully logged out"]);
    }






    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function currentUser()
    {
        return response()->json($this->guard()->user());
    }



    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
