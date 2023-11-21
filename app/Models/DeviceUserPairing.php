<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\User;

class DeviceUserPairing extends Model
{
    use HasFactory;

    protected $table = 'device_user_pairings';
    protected $fillable = [
        'user_id',
        'device_id',
    ];

    public function device() {
        return $this->belongsTo(Device::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
