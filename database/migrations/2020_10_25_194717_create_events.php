<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvents extends Migration
{
    /**
     * Create a table for the events
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 300);
            $table->date('event_date'); //Only storing the date for now, column might need upgrading to datetime later to store event time.
            $table->text('information');
        });
    }

    /**
     * Drop the events table.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
