<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitchSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitch_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('day');
            $table->date('start');
            $table->date('end');
            $table->unsignedBigInteger('pitch_id');
            $table->timestamps();

            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitch_schedules');
    }
}
