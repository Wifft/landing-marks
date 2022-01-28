<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\DeleteUserMarkRequest;
use App\Http\Requests\StoreMapRequest;
use App\Http\Requests\StoreUserMarkRequest;

use App\Models\Map;
use App\Models\UsersMap;

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

    public function storeUserMark(StoreUserMarkRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();

            UsersMap::where(
                [
                    ['map_id' =>  $data['map_id']],
                    ['user_id' =>  $data['user_id']]
                ]
            )
                ->update(
                    [
                        'mark_data' => $data['mark_data']
                    ]
                );

            return response()->json('Marker stored successfully!', 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json('Error while trying to add the marker', 500);
        }
    }

    public function deleteUserMark(DeleteUserMarkRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();

            UsersMap::where(
                [
                    ['map_id' =>  $data['map_id']],
                    ['discord_user_id' =>  $data['user_id']]
                ]
            )
                ->update(
                    [
                        'mark_data' => null
                    ]
                );

            return response()->json('Marker removed successfully!', 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json('Error while trying to remove the marker', 500);
        }
    }
}
