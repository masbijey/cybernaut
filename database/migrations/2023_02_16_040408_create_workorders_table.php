<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('title');
            $table->string('priority'); //low, medium, high
            $table->string('status'); //open, on progress, selesai
            $table->dateTime('end_date')->nullable();

            $table->integer('asset_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('department_id');
            $table->integer('employee_id')->nullable(); //updated by
            $table->integer('user_id'); //created by

        });
    }

    public function down()
    {
        Schema::dropIfExists('workorders');
    }
};
