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

            $table->string('user_id');

            $table->string('company');
            $table->string('jobtitle');
            $table->string('start');
            $table->string('end');
            $table->string('remark')->nullable();
            $table->string('file');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeexperiences');
    }
};
