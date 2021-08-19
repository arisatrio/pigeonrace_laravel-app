<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_pos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('tgl_inkorv');
            $table->string('tgl_lepasan');
            $table->string('city');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('jarak');
            $table->string('biaya_inkorv');
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
        Schema::dropIfExists('race_pos');
    }
}
