<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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

            return view('map.show', compact('map'));
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
