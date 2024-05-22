<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $sensorData = new SensorData();
        $sensorData->timestamp = $request->timestamp;
        $sensorData->sensor_type = $request->sensor_type;
        $sensorData->value = json_encode($request->value);  // Encodez les valeurs en JSON
        $sensorData->save();

        return response()->json(['status' => 'success'], 201);
    }

    public function index()
    {
        $data = SensorData::all();
        $data->each(function ($item) {
            $item->value = json_decode($item->value);  // Décodez les valeurs JSON
        });
        return $data;
    }
}
