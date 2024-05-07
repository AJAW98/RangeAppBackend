<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request) : JsonResponse
    {
        $vehicle = new Vehicle;
        $vehicle->name = $request->name;
        $vehicle->voltage = $request->voltage;
        $vehicle->batteryCapacity = $request->batteryCapacity;
        $vehicle->weight = $request->weight;
        $vehicle->user_id = $request->user()->id;

        $vehicle->save();

        return response()->json($vehicle);
    }

    public function update(Request $request): JsonResponse {
        $vehicle = Vehicle::where('id', $request->id)->update($request->all());
        return response()->json($vehicle);
    }

    public function index(Request $request) : JsonResponse {
        $vehicles = Vehicle::where('user_id', $request->user()->id)->get();
        return response()->json($vehicles);
    }

    public function show() {

    }

    public function delete() {

    }


}
