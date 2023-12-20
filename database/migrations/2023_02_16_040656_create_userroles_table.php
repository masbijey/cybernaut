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
            $table->string('signage')->nullable();
            $table->string('workorder')->nullable();
            $table->string('task')->nullable();
            $table->string('asset')->nullable();
            $table->string('voucher')->nullable();
            $table->string('beo')->nullable();
            $table->string('hris')->nullable();
            $table->string('attendance')->nullable();
            $table->string('leave')->nullable();
            $table->string('admin')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userroles');
    }
};
