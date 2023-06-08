<?php

namespace Tests\Feature\API\PushMessages;


use App\Enums\AppDeviceEnums;
use App\Enums\HeaderEnums;
use Tests\Feature\API\TestCase;

class PushMessageTest extends TestCase
{
    public function test_add_device()
    {
        $deviceKey = md5(microtime());
        $this->json('GET', 'init', [], [
            HeaderEnums::DEVICE_KEY => $deviceKey,
            HeaderEnums::DEVICE_TYPE => array_rand([AppDeviceEnums::getValues()])
        ])->assertOk();

        $this->assertDatabaseHas('device_keys', [
            'key' => $deviceKey
        ]);
    }
}
