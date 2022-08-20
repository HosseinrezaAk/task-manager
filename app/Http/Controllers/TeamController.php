<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $teams = Team::all();
        return [
          'result'=> $teams,
        ];
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $teamData = $request->all();
        $team  = new Team;
        $team->name = $teamData['name'];
        $userIDs = $teamData['userIDs'];
        $team->save();
        foreach($userIDs as $userID)
        {
            $user = User::find($userID);
            $user->teams()->attach($team);
            $team->users()->attach($user);

        }


        return [
            'status'=> 'success',
            'team' => $team

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $team = Team::find($id);

        return [
            'result' => $team
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $teamData = $request->all();
        $team = Team::find($id);
        $teamOldUsers = $team->users_ids;

        (json_encode($teamOldUsers));
        $temp = [];
        $userDiff = array_diff($teamData['userIDs'],$teamOldUsers);
        $userDiff = array_merge($temp,$userDiff); // users who are not in that team anymore

        /**
         * Delete teamID from the teams_ids of those users they are not in the team anymore
         */
        foreach($userDiff as $user){

        }
        $team->name = $teamData['name'];
        $userIDs = $teamData['userIDs'];
        foreach ($userIDs as $userID){
            $user = User::find($userID);
            $user->teams()->attach($team); // set the teamID for users

        }
        $team->users()->sync($userIDs); // set the userIDs for the team
        $team->save();
        return [
            'status'=>'success',
            'result'=> $team
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->delete();

        return [
            'status'=>'success'
        ];
    }
}
