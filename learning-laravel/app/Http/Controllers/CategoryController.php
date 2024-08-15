<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request)
    {
        if ($request->search) {
            $categories = Category::where('name', 'LIKE', "%$request->search%");
        }

        $categories = Category::all()->makeHidden(['created_at', 'updated_at']);

        return $categories;
    }

    public  function getSingleCategory($id)
    {
       $category = Category::find($id);

       return $category;
    }
}
