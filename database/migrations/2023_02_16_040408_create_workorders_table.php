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
            $table->string('order_no')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('priority'); //low, medium, high
            $table->string('status'); //open, on progress, selesai
            $table->dateTime('end_date')->nullable();
            $table->string('due_date');

            $table->unsignedBigInteger('employee_id')->nullable(); //latest updated by
            $table->integer('user_id'); //created by

        });
    }

    public function down()
    {
        Schema::dropIfExists('workorders');
    }
};
