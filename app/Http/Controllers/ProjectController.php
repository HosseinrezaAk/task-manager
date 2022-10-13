<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display all projects of a specific user
     *
     * @param string $userID
     * @return JsonResponse
     */
    public function index(string $userID): JsonResponse
    {

        $teams = Team::query()->whereIn('users_ids',[$userID])->get(); // those team that specific user are in them
        /**
         * query for projects that specific user are in the team of that project
         */
        $projects = Project::query()->with(['team'])
            ->whereHas('team' , function ($q) use($userID) {
                $q->whereIn('users_ids',[$userID]);
            })
        ->get();

        return Response::json([
            'status' => 'success',
            'response'=> $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param string $creatorID
     * @return JsonResponse
     */
    public function store(Request $request, string $creatorID): JsonResponse
    {

        $projectData = $request->all();
        $validator = Validator::make($projectData,[
            "name" => ["required","string","max:50"],
            "teamID" => ["required","string"]
        ]);
        if($validator->fails()){
            abort(400,$validator->errors());
        }

        $team = Team::query()->where('_id',$projectData['teamID'])->first();
        $creator = User::query()->where('_id',$creatorID)->get();

        $project = new Project;
        $project->name = $projectData['name'];

        $project->creatorUser()->associate($creator)->save();
        if(isset($projectData["assigneeTeamID"])){
            $project->assigneeTeam()->associate($team)->save();
        }

        $project->save();

        return Response::json([
            'status'=>'success',
            'response' => $project
        ]);
    }

    /**
     * Display the specified project
     *
     * @param string $projectID
     * @return JsonResponse
     */
    public function show(string $projectID): JsonResponse
    {
        $project = Project::query()->where('_id',$projectID)->get();

        return Response::json([
            'status'    => 'success',
            'response'  => $project
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $projectID
     * @return JsonResponse
     */
    public function update(Request $request, string $projectID): JsonResponse
    {
        $params  = $request->all();
        $newTeam = Team::query()
            ->where('_id',$params['teamID'])->first();
        $project = Project::query()
            ->where('_id',$projectID)
            ->first();
        /**
         * implement update section
         */
        $project->update($params);
        $project->team()->associate($newTeam)->save();
        return Response::json([
            'status'    => 'success',
            'response'  => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $projectID
     * @return JsonResponse
     */
    public function destroy(string $projectID): JsonResponse
    {

        Project::query()->where('_id',$projectID)->delete();
        return Response::json([
            'status'=>'success'
        ]);
    }
}
