<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name')->nullable(false);
            $table->text('description')->nullable(true);
            $table->date('start_date')->nullable(false);
            $table->string('start_date_jalali')->nullable(true);
            $table->date('end_date')->nullable(false);
            $table->string('end_date_jalali')->nullable(false);
            $table->foreignId('city_id');
            $table->string('address')->nullable(true);
            $table->string('latitude')->nullable(true);
            $table->string('longitude')->nullable(true);
            $table->float('price')->default(0);
            $table->integer('capacity')->nullable(true);
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
        Schema::dropIfExists('events');
    }
}
