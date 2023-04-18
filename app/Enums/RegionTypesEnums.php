<?php

namespace App\Enums;

use App\Models\Region;
use BenSampo\Enum\Enum;

class RegionTypesEnums extends Enum
{
    public const REGION_TYPE = Region::class;
    public const REGION_TYPES = [
        self::REGION_TYPE => 'region'
    ];
}
