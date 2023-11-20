<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeviceUserPairing;

class Device extends Model
{
    use HasFactory;
    protected $table = 'devices';
    protected $fillable = [
        'device_name',
        'email',
    ];
    public function device_user_pairing() {
        return $this->belongsToMany(DeviceUserPairing::class);
    }
}
