<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeeeducations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('employee_id');
            $table->string('institution');
            $table->string('category');
            $table->string('start');
            $table->string('end');
            $table->string('description');
            $table->string('file');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeeducations');
    }
};
