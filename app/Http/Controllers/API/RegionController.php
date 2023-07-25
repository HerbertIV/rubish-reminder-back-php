<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Dtos\Filters\RegionFiltersDto;
use App\Http\Controllers\API\Contracts\RegionControllerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionIndexRequest;
use App\Http\Resources\API\RegionResource;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionController extends Controller implements RegionControllerContract
{
    public function __construct(
        private RegionServiceContract $regionService
    ) {
    }

    public function index(RegionIndexRequest $regionIndexRequest): JsonResource
    {
        $regionFilterDto = RegionFiltersDto::init($regionIndexRequest->all());
        return RegionResource::collection($this->regionService->get($regionFilterDto));
    }

    public function checkRegion()
    {
        exit('s');
    }
}
