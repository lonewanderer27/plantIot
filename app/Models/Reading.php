<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'temperature',
        'humidity',
        'light_intensity',
        'soil_moisture',
        'water_level',
    ];

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
