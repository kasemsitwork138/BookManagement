<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexApi()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function showApi(Category $category)
    {
        return response()->json($category);
    }

    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        $category = Category::create($validated);

        return response()->json(['message' => 'Created successfully', 'category' => $category], 201);
    }

    public function updateApi(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id,
        ]);

        $category->update($validated);

        return response()->json(['message' => 'Updated successfully', 'category' => $category]);
    }

    public function destroyApi(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
