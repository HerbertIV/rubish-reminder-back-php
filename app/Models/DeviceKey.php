<?php

namespace App\Models;

use App\Models\Contracts\ReceiverContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceKey extends Model implements ReceiverContract
{
    use HasFactory;

    protected $fillable = [
        'device_key',
        'device_type'
    ];
}
