<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function addNewFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255'
        ]);

        $folder = new Folder();

        $folder->name = $request->name;

        if ($folder->save()) {
            return response()->json([
                'message' => 'Folder added',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }
}
