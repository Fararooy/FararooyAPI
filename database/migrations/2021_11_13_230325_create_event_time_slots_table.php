<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->date('time_slot_date');
            $table->string('time_slot_date_jalali')->nullable(true);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->string('created_at_jalali')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_time_slots');
    }
}
