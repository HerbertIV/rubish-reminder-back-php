<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_key',
        'device_type'
    ];
}
