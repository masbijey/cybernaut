<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeeinventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('employee_id');
            $table->string('start');
            $table->string('end')->nullable();
            $table->string('description');
            $table->string('file');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeinventories');
    }
};
