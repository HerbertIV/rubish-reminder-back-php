<?php

namespace App\Http\Controllers;

use App\Dtos\AsyncDtos\RegionDto;
use App\Enums\GarbageTypeEnums;
use App\Enums\RegionTypesEnums;
use App\Helpers\ArrayHelper;
use App\Http\Requests\AsyncRequest;
use App\Http\Resources\AsyncResource;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Http\JsonResponse;
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

    public function rubbishType(AsyncRequest $asyncRequest): JsonResource
    {
        $rubbishTypes = array_filter(
            collect(GarbageTypeEnums::getValues())->mapWithKeys(
                fn (string $rubbishType) => [$rubbishType => $rubbishType]
            )->toArray(),
            fn (string $rubbishType) => strpos($rubbishType, $asyncRequest->term) !== false
        );

        return AsyncResource::collection(
            json_decode(
                json_encode(
                    ArrayHelper::prepareArrayToSelect2(
                        $rubbishTypes
                    )
                )
            )
        );
    }

    public function regionTypes(AsyncRequest $asyncRequest): JsonResource
    {
        $regionTypes = array_filter(
            collect(RegionTypesEnums::REGION_TYPES)->mapWithKeys(
                fn (string $value, string $key) => [$key => __($value)]
            )->toArray(),
            fn (string $rubbishType) => strpos(__($rubbishType), $asyncRequest->term) !== false
        );

        return AsyncResource::collection(
            json_decode(
                json_encode(
                    ArrayHelper::prepareArrayToSelect2(
                        $regionTypes
                    )
                )
            )
        );
    }
}
