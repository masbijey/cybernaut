<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeesicknesses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('employee_id');
            $table->string('name');
            $table->string('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeesicknesses');
    }
};
