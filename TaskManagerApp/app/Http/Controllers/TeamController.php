<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = Team::all();
        return Response::json([
            'status'    => 'success',
            'response'  => $teams
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
        $team = Team::create([
            'name' => $request->input('name'),
        ]);

        $userIDs = $request->input('userIDs');
        $team->users()->attach($userIDs);

        return response()->json([
            'status' => 'success',
            'team' => $team
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $team = Team::findorfail($id);

        return Response::json([
            'status' => 'success',
            'response' => $team
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {

        $team = Team::findorfail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'userIDs' => 'array',
        ]);

        $team->name = $validatedData['name'];
        $team->save();

        if (isset($validatedData['userIDs'])) {
            $team->users()->sync($validatedData['userIDs']);
        }

        return response()->json([
            'message' => 'Team updated successfully',
            'response'=> $team
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $team = Team::findorfail($id);
        $team->users()->detach();
        $team->delete();

        return Response::json([
            'status'=>'success'
        ]);
    }
}
