<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMapsTableToAddAdminRoleIdField extends Migration
{
    /**
     * Table name.
     *
     * @property string
     */
    private static string $tableName = 'maps';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::table(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->string('admin_role_id', 255)->default('0');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::table(
            self::$tableName,
            function (Blueprint $table) : void {
                $table->dropColumn('admin_role_id');
            }
        );
    }
}
