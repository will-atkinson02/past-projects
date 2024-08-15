<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController
{
    public function getAllTeams()
    {
        $teams = Team::all();

        return response()->json([
            'message' => 'Teams retrieved',
            'success' => true,
            'data' => $teams
        ]);
    }

    public function getTeamById(int $id)
    {
        $team = Team::with('employee')->find($id);

        return response()->json([
            'message' => 'Team retrieved',
            'success' => true,
            'data' => $team
        ]);
    }

    public function addNewTeam(Request $request)
    {
        $request->validate([
           'name' => 'required|string|min:1|max:255'
        ]);

        $team = new Team();

        $team->name = $request->name;

        if ($team->save()) {
            return response()->json([
                'message' => 'Team created',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

    public function addEmployeeToTeam(int $id, Request $request)
    {
        $team = Team::find($id);
        $employee = $request->employee_id;

        $team->employees()->attach($employee);

        return response()->json([
            'message' => 'Employee added to team',
            'success' => true
        ]);
    }

    public function removeEmployeeFromTeam(int $id, Request $request)
    {
        $team = Team::find($id);
        $employee = $request->employee_id;

        $team->employees()->detach($employee);

        return response()->json([
            'message' => 'Employee removed from team',
            'success' => false
        ]);
    }
}
