<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request   $request
     * @param string    $creatorID
     * @return JsonResponse
     */
    public function store(Request $request, string $creatorID): JsonResponse
    {
        $params = $request->all();
        $validator = Validator::make($params, [
                "name" => ["required","string","max:50"],
        ]);
        if($validator->fails()){
            abort(400,$validator->errors());
        }
        // Query section **
        $creator = User::query()
            ->where("_id",$creatorID)
            ->first();
        $assigneeUser = User::query()
            ->where("_id",$params["assigneeUserID"])
            ->first();

        // Create Task section **
        $task = new Task;
        $task->name = $params['name'];
        $task->creatorUser()->associate($creator)->save();
        $task->assigneeUser()->associate($assigneeUser)->save();
        return Response::json([
            'status'    => 'success',
            'response'  => $task
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
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
