<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Contracts\CheckControllerContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CheckController extends Controller implements CheckControllerContract
{
    public function check(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true
        ]);
    }
}
