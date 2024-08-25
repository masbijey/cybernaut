<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assetallocations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('employee_id')->nullable();
            $table->integer('department_id');
            $table->integer('location_id');
            $table->integer('asset_id');
            $table->string('file');
            $table->string('condition');
            $table->string('remark')->nullable();
            $table->string('return_date')->nullable();

            $table->integer('created_by')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('assetallocations');
    }
};
