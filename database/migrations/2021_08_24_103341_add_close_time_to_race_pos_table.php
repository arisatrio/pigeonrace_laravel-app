<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloseTimeToRacePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_pos', function (Blueprint $table) {
            $table->string('close_time')->after('tgl_lepasan');
            $table->string('restart_time')->after('close_time');
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
            $table->dropColumn('close_time');
            $table->dropColumn('restart_time');
        });
    }
}
