<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiscordMapsTableToFixHasRoleField extends Migration
{
    /**
     * Table name.
     *
     * @property string
     */
    private static string $usersTableName = 'discord_users';
    private static string $usersMapsTableName = 'discord_users_maps';

    /**
     * @inheritDoc
     */
    public function up() : void
    {
        Schema::table(
            self::$usersTableName,
            function (Blueprint $table) : void {
                $table->dropColumn('has_role');
            }
        );

        Schema::table(
            self::$usersMapsTableName,
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
            self::$usersTableName,
            function (Blueprint $table) : void {
                $table->boolean('has_role')->default(false);
            }
        );

        Schema::table(
            self::$usersMapsTableName,
            function (Blueprint $table) : void {
                $table->dropColumn('has_role');
            }
        );
    }
}
