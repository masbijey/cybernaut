<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('signage', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('meeting_room');
            $table->string('event_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('signage');
    }
};
