<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('book_date');
            $table->unsignedInteger('status');
            $table->unsignedBigInteger('pitch_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('pitch_schedule_id');
            $table->timestamps();

            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('pitch_schedule_id')->references('id')->on('pitch_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
