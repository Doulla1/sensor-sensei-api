<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = ['timestamp', 'sensor_type', 'value'];

    protected $casts = [
        'value' => 'array',  // la colonne value contient un tableau JSON
    ];
}
