<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Facades\Log;

use Illuminate\View\View;

use App\Models\DiscordUser;
use App\Models\Map;

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
            $user = DiscordUser::with(['maps' => fn (BelongsToMany $query) : BelongsToMany => $query->wherePivot('map_id', $map->id)])
                ->whereHas('maps', fn (Builder $query) : Builder => $query->where('id', $map->id))
                ->find(session()->get('user_id'));

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
