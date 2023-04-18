<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'placeable_type',
        'placeable_id',
        'garbage_type',
        'execute_datetime',
    ];

    public function placeable(): MorphTo
    {
        return $this->morphTo();
    }
}
