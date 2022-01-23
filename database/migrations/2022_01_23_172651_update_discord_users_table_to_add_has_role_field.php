<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiscordUsersTableToAddHasRoleField extends Migration
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
                $table->boolean('has_role')->default(false);
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
                $table->dropColumn('has_role');
            }
        );
    }
}
