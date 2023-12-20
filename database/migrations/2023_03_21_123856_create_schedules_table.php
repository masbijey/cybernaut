<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('day');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
