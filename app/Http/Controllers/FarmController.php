<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the farmCategory relationship
        $farms = Farm::with('farmCategory')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $farms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'farm_cat_id' => 'required|exists:farm_category,id',
            'name' => 'required|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'size' => 'nullable|numeric',
            'farm_prefix' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $farm = Farm::create($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Farm created successfully.',
            'data' => $farm
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Eager load the farmCategory relationship
        $farm = Farm::with('farmCategory')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $farm
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farm = Farm::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'farm_cat_id' => 'sometimes|required|exists:farm_category,id',
            'name' => 'sometimes|required|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'size' => 'nullable|numeric',
            'farm_prefix' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $farm->update($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Farm updated successfully.',
            'data' => $farm->load('farmCategory') // Reload with relationship
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->delete(); // Soft delete

        return response()->json([
            'status' => 'success',
            'message' => 'Farm deleted successfully.'
        ], 200);
    }
}
