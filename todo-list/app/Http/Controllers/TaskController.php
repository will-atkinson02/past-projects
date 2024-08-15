<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks(Request $request)
    {
        $tasksQuery = Task::with('folder:id,name');

        if (isset($request->completed)) {
            $tasksQuery = $tasksQuery->where('completed', '=', $request->completed);
        }

        if ($request->folder) {
            $tasksQuery = $tasksQuery->where('folder_id', '=', $request->folder);
        }

        $tasks = $tasksQuery->get()->makeHidden(['folder_id', 'created_at', 'updated_at']);

        return response()->json([
           'message' => 'Tasks retrieved',
           'success' => true,
           'data' => $tasks
        ]);
    }

    public function addTask(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'folder_id' => 'required|exists:folders,id'
        ]);

        $task = new Task();

        $task->name = $request->name;
        $task->completed = false;
        $task->folder_id = $request->folder_id;

        if ($task->save()) {
            return response()->json([
                'message' => 'Task added',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

    public function deleteTask(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Invalid task Id',
                'success' => false
            ], 400);
        }

        if ($task->delete()) {
            return response()->json([
                'message' => 'Task deleted',
                'success' => true
            ]);
        }

        return request()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

    public function markTaskCompleted(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Invalid task Id',
                'success' => false
            ], 400);
        }

        $task->completed = true;

        if ($task->save()) {
            return response()->json([
                'message' => 'Task marked complete',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Something went  wrong',
            'success' => false
        ], 500);
    }
}
