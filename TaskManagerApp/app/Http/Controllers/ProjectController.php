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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigneeTeamID' => 'nullable|string|exists:teams,id',
            'assigneeUserID' => 'nullable|string|exists:users,id',
            'creatorUserID' => 'required|string|exists:users,id',
        ]);

        $project = new Project();
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->assigneeTeam()->associate($validatedData['assigneeTeamID']);
        $project->assigneeUser()->associate($validatedData['assigneeUserID']);
        $project->creatorUser()->associate($validatedData['creatorUserID']);
        $project->save();

        return response()->json(['message' => 'Project created successfully', 'project' => $project]);
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

        $project = Project::findorfail($projectID);
        /**
         * implement update section
         */
        if(isset($params["assigneeTeamID"])){
            $newTeam = Team::query()
                ->where('_id',$params['assigneeTeamID'])->first();
            $project->assigneeTeam()->associate($newTeam)->save();
            $project->assigneeUser()->associate(null)->save();
        }
        if(isset($params["assigneeUserID"])){
            $newUser = User::query()
                ->where('_id', $params["assigneeUserID"])->first();
            $project->assigneeUser()->associate($newUser)->save();
            $project->assigneeTeam()->associate(null)->save();

        }

        $project->update($params);

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
     *
     * TODO: Delete tasks of this project ,
     */
    public function destroy(string $projectID): JsonResponse
    {


        Project::query()->where('_id',$projectID)->delete();
        return Response::json([
            'status'=>'success'
        ]);
    }
}
