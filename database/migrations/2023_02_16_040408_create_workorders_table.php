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
            $table->string('priority');
            $table->string('status'); 
            $table->string('due_date');

            $table->integer('received_by')->nullable();
            $table->dateTime('received_date')->nullable();

            $table->integer('created_by')->nullable();

            $table->integer('finished_by')->nullable();
            $table->dateTime('finished_date')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('workorders');
    }
};
