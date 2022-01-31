<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\StoreUserActivityRequest;

use App\Models\DiscordUserActivity;

use Throwable;

final class UserActivitiesController extends Controller
{
    public function store(StoreUserActivityRequest $request) : JsonResponse
    {
        try {
            $data = $request->all();

            DiscordUserActivity::create($data);

            return response()->json('Activity logged successfully');
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json('Error while trying to log the activity', 500);
        }
    }
}
