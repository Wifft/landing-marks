<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiscordUsersTableToAddNicknameField extends Migration
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
        Schema::table(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->string('nickname');
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function down() : void
    {
        Schema::table(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->dropColumn('nickname');
            }
        );
    }
}
