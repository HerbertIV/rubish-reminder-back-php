<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class TemplateController extends Controller
{
    public function __construct()
    {
    }

    public function index(): View
    {
        return view('pages.template.index');
    }

    public function create(): View
    {
        return view('pages.template.create');
    }

    public function show(Region $region): View
    {
        return view('pages.template.show', ['region' => $region]);
    }

    public function edit(Region $region): View
    {
        return view('pages.template.edit', ['region' => $region]);
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
