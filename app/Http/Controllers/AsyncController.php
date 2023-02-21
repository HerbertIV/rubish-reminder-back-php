<?php

namespace App\Http\Controllers;

use App\Dtos\AsyncDtos\RegionDto;
use App\Http\Requests\AsyncRequest;
use App\Http\Resources\AsyncResource;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Http\Resources\Json\JsonResource;

class AsyncController extends Controller
{
    public function __construct(
        private AsyncServiceContract $asyncService
    ) {
    }

    public function regions(AsyncRequest $asyncRequest): JsonResource
    {
        $regionDto = new RegionDto($asyncRequest->all());
        return AsyncResource::collection($this->asyncService->regions($regionDto));
    }
}
