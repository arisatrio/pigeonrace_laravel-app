<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLimitDayToRacePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_pos', function (Blueprint $table) {
            $table->integer('limit_day')->nullable()->after('restart_time');
            $table->integer('limit_speed')->nullable()->after('limit_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('race_pos', function (Blueprint $table) {
            $table->dropColumn('limit_day');
            $table->dropColumn('limit_speed');
        });
    }
}
