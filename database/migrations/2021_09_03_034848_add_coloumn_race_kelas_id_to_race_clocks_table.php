<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnRaceKelasIdToRaceClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_clocks', function (Blueprint $table) {
            $table->foreignId('race_kelas_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->after('burung_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('race_clocks', function (Blueprint $table) {
            $table->dropColumn('race_kelas_id');
        });
    }
}
