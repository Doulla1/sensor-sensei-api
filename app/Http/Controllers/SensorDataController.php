<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $timestamp = $request->timestamp;
        $sensors = $request->sensors;

        foreach ($sensors as $sensorType => $sensorValues) {
            foreach ($sensorValues as $valueType => $value) {
                $sensorData = new SensorData();
                $sensorData->timestamp = $timestamp;
                $sensorData->sensor_type = "{$sensorType}_{$valueType}";
                $sensorData->value = json_encode($value);  // Stockez la valeur comme JSON
                $sensorData->save();
            }
        }

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
