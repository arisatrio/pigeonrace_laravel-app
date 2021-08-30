<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBurungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('burungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('tahun');
            $table->string('no_ring');
            $table->string('warna');
            $table->string('jenkel');
            $table->string('titipan')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('burungs');
    }
}
