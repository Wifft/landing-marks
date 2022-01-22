<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;

use App\Models\DiscordUser;

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
        $discordSocialiteInstance = Socialite::driver('discord')->stateless();

        $userData = $discordSocialiteInstance->user();

        $user = DiscordUser::updateOrCreate(
            ['discord_id' => $userData->id],
            ['nickname' => $userData->nickname]
        );

        session()->put('discord_id', $user->discord_id);
        session()->put('discord_nickname', $user->nickname);

        return redirect()->route('map.show', ['uuid' => session()->get('map_uuid')]);
    }
}
