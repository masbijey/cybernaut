<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filebanks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('userlevel_id')->nullable();
            $table->integer('workorder_id')->nullable();
            $table->integer('task_id')->nullable();
            $table->string('contract_file')->nullable();
            $table->string('maintenance_before')->nullable();
            $table->string('maintenance_after')->nullable();
            $table->string('workorder_before')->nullable();
            $table->string('workorder_after')->nullable();
            $table->integer('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('filebanks');
    }
};
