<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\RegionDto;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RegionController extends Controller
{
    public function __construct(
        private RegionServiceContract $regionService
    ) {
    }

    public function index(): View
    {
        return view('pages.region.index');
    }

    public function create(): View
    {
        return view('pages.region.create');
    }

    public function show(Region $region): View
    {
        return view('pages.region.show', ['region' => $region]);
    }

    public function edit(Region $region): View
    {
        return view('pages.region.edit', ['region' => $region]);
    }

    public function destroy(Region $region)
    {
        $this->regionService->delete($region->getKey());
    }

    //Currently using livewire
    public function store(RegionRequest $request): JsonResponse
    {
        $regionDto = new RegionDto($request->validated());
        $this->regionService->create($regionDto);
        return response()->json([
            'success' => true
        ], JsonResponse::HTTP_CREATED);
    }

    //Currently using livewire
    public function update(RegionRequest $request, Region $region): JsonResponse
    {
        $regionDto = new RegionDto($request->validated());
        $this->regionService->update($regionDto, $region->getKey());
        return response()->json([
            'success' => true
        ]);
    }
}
