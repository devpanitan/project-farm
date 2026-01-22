<?php

namespace App\Http\Controllers;

use App\Models\FarmCategory; // Use the new FarmCategory model
use Illuminate\Http\Request;

class FarmCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FarmCategory::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug line removed. Ready for normal operation.

        $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        $category = FarmCategory::create([
            'cat_name' => $request->cat_name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully.',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = FarmCategory::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cat_name' => 'sometimes|required|string|max:255',
        ]);

        $category = FarmCategory::findOrFail($id);
        $category->update([
            'cat_name' => $request->cat_name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully.',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = FarmCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully.'
        ], 200);
    }
}
