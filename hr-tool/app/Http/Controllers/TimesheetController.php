<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController
{
    public function addTimesheet(Request $request)
    {
        $request->validate([
            'time' => 'required|int|min:0',
            'notes' => 'string|max:255',
            'employee_id' => 'required|exists:employees,id'
        ]);

        $timesheet = new Timesheet();

        $timesheet->time = $request->time;
        $timesheet->notes = $request->notes;
        $timesheet->employee_id  = $request->employee_id;

        if ($timesheet->save()) {
            return response()->json([
                'message' => 'Timesheet created',
                'status' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Timesheet creation failed',
            'status' => false
        ], 500);
    }

    public function getAllTimesheets(Request $request)
    {
        $timesheets = Timesheet::all();

        return response()->json([
            'message' => 'Timesheets retrieved',
            'status' => true,
            'data' => $timesheets
        ]);
    }

    public function getTimesheetsByEmployee(int $id)
    {
        $timesheets = Timesheet::where('employee_id', '=', $id)->get();

        return response()->json([
            'message' => 'Timesheets retrieved',
            'status' => true,
            'data' => $timesheets
        ]);
    }

    public function updateTimesheet(int $id, Request $request)
    {
        $request->validate([
            'time' => 'int|min:0',
            'notes' => 'string|max:255',
            'employee_id' => 'exists:employees,id'
        ]);

        $timesheet = Timesheet::find($id);

        if (!$timesheet) {
            return response()->json([
                'message' => 'Invalid timesheet ID',
                'success' => false
            ], 400);
        }

        $timesheet->time = $request->time ?? $timesheet->time;
        $timesheet->notes = $request->notes ?? $timesheet->notes;
        $timesheet->employee_id  = $request->employee_id ?? $timesheet->employee_id;

        if ($timesheet->save()) {
            return response()->json([
                'message' => 'Timesheet updated',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }
}
