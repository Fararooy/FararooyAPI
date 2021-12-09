<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id');
            $table->string('bar_code_url')->nullable(true);
            $table->string('qr_code_url')->nullable(true);
            $table->dateTime('issue_date');
            $table->string('issue_date_jalali')->nullable(true);
            $table->boolean('used')->default(false);
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
        Schema::dropIfExists('tickets');
    }
}
