<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Dtos\API\CheckRegionDto;
use App\Dtos\Filters\RegionFiltersDto;
use App\Enums\HeaderEnums;
use App\Http\Controllers\API\Contracts\RegionControllerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckRegionRequest;
use App\Http\Requests\RegionIndexRequest;
use App\Http\Resources\API\RegionResource;
use App\Services\Contracts\DeviceKeyServiceContract;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionController extends Controller implements RegionControllerContract
{
    public function __construct(
        private RegionServiceContract $regionService,
        private DeviceKeyServiceContract $deviceKeyService
    ) {
    }

    public function index(RegionIndexRequest $regionIndexRequest): JsonResource
    {
        $regionFilterDto = RegionFiltersDto::init($regionIndexRequest->all());
        return RegionResource::collection($this->regionService->get($regionFilterDto));
    }

    public function checkRegion(CheckRegionRequest $checkRegionRequest)
    {
        $this->deviceKeyService->checkRegions(
            CheckRegionDto::init(
                array_merge($checkRegionRequest->all(), [
                    'device_key' => $checkRegionRequest->header(HeaderEnums::DEVICE_KEY),
                    'device_type' => $checkRegionRequest->header(HeaderEnums::DEVICE_TYPE),
                ])
            )
        );
    }
}
