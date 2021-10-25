<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_clocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('race_pos_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('race_kelas_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('burung_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('distance');
            $table->string('arrival_date');
            $table->string('arrival_day');
            $table->string('arrival_clock');
            $table->string('flying_time');
            $table->float('velocity');
            $table->string('no_stiker');
            $table->string('status')->default('BELUM VALIDASI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_clocks');
    }
}
