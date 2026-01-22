<?php

namespace App\Http\Controllers;

use App\Models\IotDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IotDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iotDevices = IotDevice::with('farm:id,name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $iotDevices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'farm_id' => 'required|exists:farms,id',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'unit' => 'nullable|string|max:50',
            'uuid' => 'nullable|string|max:45|unique:iot_devices,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        // ถ้าไม่ได้ส่ง uuid มา, ให้สร้างขึ้นมาใหม่
        if (empty($data['uuid'])) {
            $data['uuid'] = (string) Str::uuid();
        }

        $iotDevice = IotDevice::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'IoT Device created successfully.',
            'data' => $iotDevice
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(IotDevice $iotDevice)
    {
        $iotDevice->load('farm:id,name,farm_prefix');
        return response()->json([
            'status' => 'success',
            'data' => $iotDevice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IotDevice $iotDevice)
    {
        $validator = Validator::make($request->all(), [
            'farm_id' => 'sometimes|required|exists:farms,id',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|nullable|boolean',
            'unit' => 'sometimes|nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $iotDevice->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'IoT Device updated successfully.',
            'data' => $iotDevice
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IotDevice $iotDevice)
    {
        $iotDevice->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'IoT Device deleted successfully.'
        ], 200);
    }
}
