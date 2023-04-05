<?php

namespace App\Variables\Mails;

use App\Events\Templates\EventWrapper;
use App\Models\User;

class ProcessUserEmailChangeVariable extends EmailVariables
{
    public const VAR_PROCESS_URL = '@VarProcessUrl';

    public static function mockedVariables(array $data = []): array
    {
        $faker = \Faker\Factory::create();
        return array_merge($data, [
            self::VAR_PROCESS_URL => $faker->url,
        ]);
    }

    public static function variablesFromEvent(EventWrapper $event): array
    {
        return array_merge(parent::variablesFromEvent($event), [
            self::VAR_PROCESS_URL => route('user.process.email', ['token' => $event->getUser()->process_token]),
        ]);
    }

    public static function getVariables(): array
    {
        return [
            self::VAR_PROCESS_URL
        ];
    }

    public static function assignableClass(): ?string
    {
        return User::class;
    }
}
