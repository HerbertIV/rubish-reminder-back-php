<?php

namespace App\Variables\Push;

use App\Enums\GarbageTypeEnums;
use App\Events\Templates\EventWrapper;
use App\Models\Schedule;
use Carbon\Carbon;

class PushReminderEventVariable extends PushVariables
{
    public const VAR_GARBAGE_TYPE = '@VarGarbageType';
    public const VAR_DATE_EXECUTE = '@VarDateExecute';

    public static function mockedVariables(array $data = []): array
    {
        $faker = \Faker\Factory::create();
        return array_merge($data, [
            self::VAR_GARBAGE_TYPE => $faker->randomElement(GarbageTypeEnums::getValues()),
            self::VAR_DATE_EXECUTE => $faker->date(),
        ]);
    }

    public static function variablesFromEvent(EventWrapper $event): array
    {
        return array_merge(parent::variablesFromEvent($event), [
            self::VAR_GARBAGE_TYPE => __($event->getSchedule()->garbage_type),
            self::VAR_DATE_EXECUTE => Carbon::make($event->getSchedule()->execute_datetime)->format('d-m-Y'),
        ]);
    }

    public static function getVariables(): array
    {
        return [
            self::VAR_GARBAGE_TYPE,
            self::VAR_DATE_EXECUTE,
        ];
    }

    public static function assignableClass(): ?string
    {
        return Schedule::class;
    }
}
