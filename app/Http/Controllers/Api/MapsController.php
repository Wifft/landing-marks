<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\StoreMapRequest;

use App\Models\Map;

use Throwable;

final class MapController extends Controller
{
    public function store(StoreMapRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();

            Map::create($data);

            return response()->json('Map created successfully!', 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json('Error while trying to create a map', 500);
        }
    }
}
