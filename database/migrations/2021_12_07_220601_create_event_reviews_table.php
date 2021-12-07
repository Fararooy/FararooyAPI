<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->foreignId('user_id');
            $table->text('review_text');
            $table->integer('rating')->default(0);
            $table->dateTime('deleted_at')->nullable()->default(null);
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
        Schema::dropIfExists('event_reviews');
    }
}
