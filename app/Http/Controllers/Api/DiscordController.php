<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Cookie;

use App\Http\Clients\DiscordClient;

use App\Models\DiscordUser;
use App\Models\Map;
use App\Models\UsersMap;

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
        $mapData = Map::with(['discordUsers'])->where('uuid', $sessionData['map_uuid'])->first();

        $discordClient = new DiscordClient($userData->token);

        $user = DiscordUser::updateOrCreate(
            ['discord_id' => $userData->id],
            [
                'nickname' => $userData->nickname,
                'token' => $userData->token,
                'avatar' => $userData->avatar
            ]
        );

        UsersMap::updateOrCreate(
            [
                'map_id' => $mapData->id,
                'discord_user_id' => $user->id
            ],
            [
                'has_role' => $discordClient->hasServerRole($mapData->guild_id, $userData->id, $mapData->role_id)
            ]
        );

        Cookie::queue(Cookie::forever('user_id', $user->id));

        return redirect()->route('map.show', ['uuid' => $sessionData['map_uuid']]);
    }
}
