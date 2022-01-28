<?php

use App\Http\Controllers\Api\DiscordController;
use App\Http\Controllers\Api\MapController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(
    static function () : void {
        Route::prefix('maps')->group(
            static function () : void {
                Route::put('storeUserMark', [MapController::class, 'storeUserMark'])->name('api.maps.storeUserMark');
                Route::put('deleteUserMark', [MapController::class, 'deleteUserMark'])->name('api.maps.deleteUserMark');
            }
        );
    }
);
