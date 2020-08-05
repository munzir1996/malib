<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitchCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitch_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('customer_id');
            $table->foreignId('pitch_id');
            $table->timestamps();

            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitch_comments');
    }
}
