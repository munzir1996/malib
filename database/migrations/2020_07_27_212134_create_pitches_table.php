<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('location');
            $table->text('discription');
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitches');
    }
}
