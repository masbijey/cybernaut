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
            $table->integer('user_id');
            
            $table->string('nip')->nullable();
            $table->string('gender')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nik')->nullable();
            $table->string('religion')->nullable();
            $table->string('bornplace')->nullable();
            $table->string('borndate')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('active');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
