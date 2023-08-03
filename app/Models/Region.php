<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Region::class, 'parent_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function deviceKeys(): MorphToMany
    {
        return $this->morphedByMany(
            DeviceKey::class,
            'receiverable',
            'regions_has_receiver'
        );
    }
}
