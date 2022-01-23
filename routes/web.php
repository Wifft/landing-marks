<?php

use App\Http\Controllers\Api\DiscordController;
use App\Http\Controllers\MapsController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () : View => view('welcome'));

Route::get('map/{uuid}', [MapsController::class, 'show'])->name('map.show');

Route::get('discord-login', fn() : RedirectResponse => Socialite::driver('discord')->redirect())
    ->name('discord.login');

Route::get('api/v1/discord/authCallback', [DiscordController::class, 'authCallback'])
    ->name('discord.auth_callback');
