<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
     * @param string    $projectID
     * @return JsonResponse
     */
    public function store(Request $request, string $creatorID, string $projectID): JsonResponse
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
        $project = Project::query()
            ->where("_id", $projectID)
            ->first();

        // Create Task section **

        /*
         * TODO IF the user in the same team as the project team_id of the task
         */
        $task = new Task;
        $task->name = $params['name'];
        $task->creatorUser()->associate($creator)->save();
        $task->assigneeUser()->associate($assigneeUser)->save();
        $task->project()->associate($project)->save();
        return Response::json([
            'status'    => 'success',
            'response'  => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $taskID
     * @return JsonResponse
     */
    public function show(Request $request, string $taskID): JsonResponse
    {
        $task = Task::query()
            ->where("_id",$taskID)
            ->first();
        /**
         * TODO : Check if the user is eligible for seeing this task
         */
        return Response::json([
            'status'    => 'success',
            'response'  => $task
        ]);
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
