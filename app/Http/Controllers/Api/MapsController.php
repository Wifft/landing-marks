<?php
namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\DeleteUserMarkRequest;
use App\Http\Requests\StoreMapRequest;
use App\Http\Requests\StoreUserMarkRequest;

use App\Models\Map;
use App\Models\UsersMap;

use Throwable;

final class MapsController extends Controller
{
    public function getUuidByGuildId(string $guildId) : JsonResponse
    {
        try {
            $map = Map::select(['uuid'])->where('guild_id', $guildId)->orderBy('updated_at', 'desc')->firstOrFail();

            return response()->json($map->toArray(), 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Map not found'], 404);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response(['message' => $e->getMessage()], 500);
        }
    }

    public function store(StoreMapRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $data['uuid'] = Str::uuid();

            Map::create($data);

            return response()->json(['message' => 'Map created successfully!'], 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json(['message' => 'Error while trying to create a map'], 500);
        }
    }

    public function storeUserMark(StoreUserMarkRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();

            UsersMap::where(
                [
                    ['map_id',  $data['map_id']],
                    ['discord_user_id',  $data['discord_user_id']]
                ]
            )
                ->update(
                    [
                        'marker_data' => $data['marker_data']
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
                    ['map_id', $data['map_id']],
                    ['discord_user_id',  $data['discord_user_id']]
                ]
            )
                ->update(
                    [
                        'marker_data' => null
                    ]
                );

            return response()->json('Marker removed successfully!', 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json('Error while trying to remove the marker', 500);
        }
    }
}
