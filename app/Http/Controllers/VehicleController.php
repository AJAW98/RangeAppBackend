<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(VehicleRequest $request): JsonResponse
    {
        // Use the validated data directly
        $validatedData = $request->validated();

        // Ensure the authenticated user's ID is added to the vehicle data
        $validatedData['user_id'] = $request->user()->id;

        // Create a new Vehicle instance with the validated data
        $vehicle = Vehicle::create($validatedData);

        // Return the newly created vehicle as a JSON response
        return response()->json($vehicle);
    }


    public function update(VehicleRequest $request): JsonResponse {
        $vehicle = Vehicle::findOrFail($request->id);
        $vehicle->update($request->validated());

        return response()->json($vehicle);
    }

    public function index(Request $request) : JsonResponse {
        $vehicles = Vehicle::where('user_id', $request->user()->id)->get();
        return response()->json($vehicles);
    }

    public function show(Request $request) {
        $vehicle = Vehicle::where('id', $request->id)->get();
        return response()->json($vehicle);
    }

    public function delete() {

    }


}
