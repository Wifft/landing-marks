<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\MapsController;
use App\Http\Controllers\Api\UserActivitiesController;

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
                Route::put('storeUserMark', [MapsController::class, 'storeUserMark'])
                    ->name('api.maps.storeUserMark');
                Route::put('deleteUserMark', [MapsController::class, 'deleteUserMark'])
                    ->name('api.maps.deleteUserMark');
            }
        );

        Route::prefix('user-activities')->group(
            static function () : void {
                Route::post('store', [UserActivitiesController::class, 'store'])
                    ->name('api.userActivities.store');
            }
        );
    }
);
