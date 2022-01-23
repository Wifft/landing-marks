<?php
namespace App\Http\Controllers\Api;

use App\Http\Clients\DiscordClient;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;

use App\Models\DiscordUser;
use App\Models\Map;
use Laravel\Socialite\Facades\Socialite;

final class DiscordController extends Controller
{
    /**
     * Callback that authenticates the given user.
     *
     * @return \Illuminate\Http\Response\RedirectResponse
     */
    public function authCallback() : RedirectResponse
    {
        $sessionData = session()->all();

        $discordSocialiteInstance = Socialite::driver('discord')->stateless();

        $userData = $discordSocialiteInstance->user();
        $mapData = Map::with(['discordUsers'])->where('uuid', $sessionData['uuid'])->first();

        $discordClient = new DiscordClient($userData->token);

        $user = DiscordUser::updateOrCreate(
            ['discord_id' => $userData->id],
            [
                'nickname' => $userData->nickname,
                'token' => $userData->token,
                'avatar' => $userData->avatar,
                'has_role' => $discordClient->hasServerRole($mapData->guild_id, $userData->id, $mapData->role_id)
            ]
        );

        session()->put('user_id', $user->id);

        return redirect()->route('map.show', ['uuid' => $sessionData['uuid']]);
    }
}
