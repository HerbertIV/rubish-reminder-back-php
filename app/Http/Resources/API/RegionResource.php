<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OT;

#[OT\Schema(schema: 'Region', title: 'Region')]
class RegionResource extends JsonResource
{
    #[OT\Property(property: 'id', type: 'integer', nullable: false)]
    #[OT\Property(property: 'name', type: 'string', nullable: true)]
    public function toArray($request)
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
        ];
    }
}
