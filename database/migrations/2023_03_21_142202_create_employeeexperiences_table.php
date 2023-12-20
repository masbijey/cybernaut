<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeeexperiences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('employee_id');
            $table->string('company');
            $table->string('jobtitle');
            $table->string('start');
            $table->string('end');
            $table->string('description');
            $table->string('file');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeexperiences');
    }
};
