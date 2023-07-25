<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Contracts;

use App\Enums\HeaderEnums;
use App\Http\Requests\RegionIndexRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OT;

interface RegionControllerContract
{
    #[OT\Get(
        path: '/api/regions',
        tags: ['Get active regions'],
        description: 'It is endpoints list with active regions'
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
        content: new OT\JsonContent(ref: '#/components/schemas/Region'),
    )]
    #[OT\Response(response: 422, description: 'Unprocessable content')]
    public function index(RegionIndexRequest $regionIndexRequest): JsonResource;
}
