<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceBasketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_basketings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_pos_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('burung_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('race_kelas_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('race_basketings');
    }
}
