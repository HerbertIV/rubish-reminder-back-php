<?php

namespace App\Http\Controllers\API\Contracts;

use App\Enums\HeaderEnums;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OT;

interface CheckControllerContract
{
    #[OT\Get(
        path: '/api/check',
        tags: ['Check App'],
        description: 'It is initialize device in DB'
    )]
    #[OT\Parameter(
        name: HeaderEnums::DEVICE_KEY,
        in: 'header',
        required: false,
        schema: new OT\Schema(type: 'string')
    )]
    #[OT\Parameter(
        name: HeaderEnums::DEVICE_TYPE,
        in: 'header',
        required: false,
        schema: new OT\Schema(type: 'string')
    )]
    #[OT\Response(
        response: 200,
        description: 'Successful operation',
        content: new OT\JsonContent(examples: [
            new OT\Examples(
                example: "result",
                value: ["success" => true],
                summary: "An result object."
            )
        ]),
    )]
    #[OT\Response(response: 422, description: 'Unprocessable content')]
    public function check(Request $request): JsonResponse;
}
