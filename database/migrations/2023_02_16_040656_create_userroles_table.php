<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('userroles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id');
            $table->string('admin')->nullable();
            $table->string('asset')->nullable();
            $table->string('hris')->nullable();
            $table->string('maintenance')->nullable();
            $table->string('business')->nullable();
            $table->string('room')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userroles');
    }
};
