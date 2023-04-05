<?php

namespace App\Variables\Mails;

use App\Events\Templates\EventWrapper;
use function config;

abstract class EmailVariables
{
    public const VAR_APP_NAME = '@VarAppName';

    public static function mockedVariables(array $data = []): array
    {
        return array_merge($data, [
            self::VAR_APP_NAME => config('app.name'),
        ]);
    }

    public static function variablesFromEvent(EventWrapper $event): array
    {
        return [
            self::VAR_APP_NAME => config('app.name'),
        ];
    }

    public static function getVariables(): array
    {
        return [
            self::VAR_APP_NAME
        ];
    }
}
