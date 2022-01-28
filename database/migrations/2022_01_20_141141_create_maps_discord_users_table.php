<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\DiscordUser;
use App\Models\Map;

class CreateMapsDiscordUsersTable extends Migration
{
    /**
     * Table name.
     *
     * @property string
     */
    private static string $tableName = 'discord_users_maps';

    /**
     * @inheritDoc
     */
    public function up() : void
    {
        Schema::create(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->foreignIdFor(DiscordUser::class);
                $table->foreignIdFor(Map::class);
                $table->primary(['discord_user_id', 'map_id']);

                $table->json('marker_data')->nullable();
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function down() : void
    {
        Schema::dropIfExists(self::$tableName);
    }
}
