<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\RegionDto;
use App\Http\Requests\RegionCreateRequest;
use App\Models\Region;
use App\Services\Contracts\RegionServiceContract;
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
    public function store(RegionCreateRequest $request)
    {
        $regionDto = new RegionDto($this->toArray());
        $this->regionService->create($regionDto);
        return response()->json([
            'success' => true
        ]);
    }

    //Currently using livewire
    public function update(RegionCreateRequest $request, Region $region)
    {
        $regionDto = new RegionDto($this->toArray());
        $this->regionService->update($regionDto, $region->getKey());
        return response()->json([
            'success' => true
        ]);
    }
}
