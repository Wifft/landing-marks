<?php

use App\Models\DiscordUser;
use App\Models\Map;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordUsersActivitiesTable extends Migration
{
    /**
     * Table name.
     *
     * @property string
     */
    private static string $tableName = 'discord_user_activities';

    /**
     * @inheritDoc
     */
    public function up() : void
    {
        Schema::create(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->id();
                $table->string('message', 255);
                $table->foreignIdFor(DiscordUser::class);
                $table->foreignIdFor(Map::class);
                $table->timestamps();
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
