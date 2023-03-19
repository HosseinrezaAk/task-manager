<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

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
        $updateData = $request->all();
        $user = User::query()
            ->where('_id',$userID)
            ->update($updateData);

        return Response::json([
            'status'    => 'success',
            'response'  => $user
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
        $user = User::query()->where('_id',$id);
        $user->delete();

        return Response::json([
            "status"=>"Success"
        ]);
    }
}
