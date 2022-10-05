<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;


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
        $userData = $request->all();
        $user = new User;
        $user->name = $userData['name'];
        $user->password = $userData['password'];
        $user->save();

        return Response::json([
            'status'    => 'success',
            'response'  => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::query()->where('_id',$userID)->get();

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
