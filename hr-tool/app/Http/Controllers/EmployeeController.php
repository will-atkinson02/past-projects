<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController
{
    public function all()
    {
        // The with method allows us to load ba models relationships
        // It is safe to hide foreignIds with makeHidden because it runs after the query has executed
        $employees = Employee::with('contract:id,name')
            ->get()
            ->makeHidden(['notes']);

        return response()->json([
            'message' => 'Employees retrieved',
            'success' => true,
            'data' => $employees
        ]);
    }

    public function getSingleEmployee(int $id)
    {
        $employee = Employee::with('timesheets:id,time,notes,employee_id')
            ->with('teams')
            ->find($id);

        return response()->json([
            'message' => 'Employee retrieved',
            'success' => true,
            'data' => $employee
        ]);
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'prefix' => 'required|string|max:255',
                'number' => 'required|integer|min:0',
                'notes' => 'string|max:1000',
                'contract_id' => 'integer|exists:contracts,id'
            ]
        );

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->prefix = $request->prefix;
        $employee->number = $request->number;
        $employee->notes = $request->notes;
        $employee->contract_id = $request->contract_id;

        if ($employee->save()) {
            return response()->json([
                'message' => 'Employee created',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'There was an error',
            'success' => false
        ], 500);
    }
}
