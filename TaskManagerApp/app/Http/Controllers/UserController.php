<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return Response::json([
            'status'    => 'success',
            'response'  => $users
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ]);

        return response()->json([
            'status' => 'success',
            'response' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $userID
     * @return JsonResponse
     */
    public function show(string $userID): JsonResponse
    {
        $user = User::find($userID);
        if (!$user) {
            return Response::json([
                'status' => 'error',
                'message' => 'User not found',
            ]);
        }

        return Response::json([
            'status' => 'success',
            'user' => $user,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param   Request   $request
     * @param   string    $userID
     * @return  JsonResponse
     */
    public function update(Request $request, string $userID): JsonResponse
    {
        $user = User::where('_id', $userID)->firstOrFail();
        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'response' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(String $id): JsonResponse
    {
        $user = User::findorfail($id);
        $user->teams()->detach();
        $user->delete();

        return Response::json([
            "status"=>"Success"
        ]);
    }
}
