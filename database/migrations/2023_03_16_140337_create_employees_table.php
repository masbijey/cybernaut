<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->string('npwp');
            $table->string('nik');
            $table->string('religion');
            $table->string('bornplace');
            $table->string('borndate');
            $table->string('address');
            $table->string('phone');
            $table->string('status_perkawinan');
            $table->string('joindate');
            $table->string('email');
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
