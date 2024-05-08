<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return true;
        }

        $vehicleId = $this->route('vehicle');  // Adjust based on your route parameter
        $vehicle = Vehicle::find($vehicleId);

        // Use $this->user() to get the authenticated user via Sanctum
        return $vehicle && $vehicle->user_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'voltage' => 'sometimes|numeric',
            'battery_capacity' => 'sometimes|numeric',
            'battery_level' => 'sometimes|numeric|min:0|max:100',
            'weight' => 'sometimes|numeric',
            'user_id' => 'sometimes|numeric'
        ];
    }
}
