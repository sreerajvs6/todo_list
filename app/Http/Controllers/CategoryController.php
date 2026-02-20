<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return \App\Models\Category::all();
    }

    public function store(Request $request)
    {
        $category = \App\Models\Category::updateOrCreate(
            ['name' => $request->name],
            ['color' => $request->color]
        );
        return response()->json(['status' => 'success', 'id' => $category->id]);
    }

    public function destroy($id)
    {
        \App\Models\Category::destroy($id);
        return response()->json(['status' => 'success']);
    }
}
