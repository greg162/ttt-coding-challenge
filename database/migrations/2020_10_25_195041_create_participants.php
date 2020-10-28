<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipants extends Migration
{
    /**
     * Create the table for the participants
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Drop the table for the participants
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
