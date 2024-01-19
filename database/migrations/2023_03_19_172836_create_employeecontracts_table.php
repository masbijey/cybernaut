<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeecontracts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('user_id');
            $table->string('start');
            $table->string('end');
            $table->integer('department_id');
            $table->string('level');
            $table->string('jobtitle');
            $table->string('remark')->nullable();
            $table->string('file');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeecontracts');
    }
};
