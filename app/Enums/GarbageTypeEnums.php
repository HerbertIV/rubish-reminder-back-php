<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class GarbageTypeEnums extends Enum
{
    public const SEGREGATED = 'segregated';
    public const SEGREGATED_WITHOUT_GLASS = 'segregated_without_glass';
    public const MIXED_UP   = 'mixed_up';

    public const PLASTIC    = 'plastic';
    public const GLASS      = 'glass';
    public const PAPER      = 'paper';
}
