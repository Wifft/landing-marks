<?php
namespace App\Http\Clients;

use Illuminate\Support\Facades\Log;

use App\Enums\HttpMethods;

use Exception;
use Throwable;

final class DiscordClient
{
    /**
     * Hardcoded base URL.
     *
     * @property string
     */
    private string $baseUrl = "https://discord.com/api";

    /**
     * Provided API token.
     *
     * @property string
     */
    private string $token;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Checks if the provided user of the provided server has the provided role.
     *
     * @param int $guildId provided server ID.
     * @param int $userId provided user ID.
     * @param int $roleId provided role ID.
     *
     * @return bool
     */
    public function hasServerRole(int $guildId, int $userId, int $roleId) : bool
    {
        $response = $this->makeRequest("users/@me/guilds/$guildId/member", HttpMethods::GET);

        if (!isset($response->roles)) {
            throw new Exception('Unauthorized', 403);
        }

        return !is_null($response) && in_array($roleId, $response->roles);
    }

    /**
     * Makes the request.
     *
     * @param string $endpoint target endpoint.
     * @param string $method used HTTP method.
     *
     * @return object|null
     */
    private function makeRequest(string $endpoint, string $method) : ? object
    {
        try {
            $ch = curl_init($this->baseUrl . '/' . $endpoint);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->token
                ]
            );

            $result = curl_exec($ch);

            curl_close($ch);
            unset($ch);

            $query = json_decode($result);

            if (!$query) {
                throw new Exception('Invalid response');
            }

            return $query;
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return null;
        }
    }
}
