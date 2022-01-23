<?php
namespace App\Http\Controllers;

use App\Models\DiscordUser;
use App\Models\Map;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;

use Illuminate\View\View;

use Throwable;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class MapsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function show(string $uuid) : ? View
    {
        try {
            $map = Map::with(['discordUsers', 'activities'])->where('uuid', $uuid)->firstOrFail();
            $user = DiscordUser::select('nickname', 'avatar', 'has_role')->find(session()->get('user_id'));

            session()->put('map_uuid', $uuid);

            return view('pages.map', compact('map', 'user'));
        } catch (ModelNotFoundException) {
            abort(404, 'Not found');

            return null;
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            abort(500, 'Error');

            return null;
        }
    }
}
