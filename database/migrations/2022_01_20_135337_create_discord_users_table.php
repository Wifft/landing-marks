<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordUsersTable extends Migration
{
     /**
     * Table name.
     *
     * @property string
     */
    private static string $tableName = 'discord_users';

    /**
     * @inheritDoc
     */
    public function up() : void
    {
        Schema::create(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->id();
                $table->string('nickname', 255);
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
