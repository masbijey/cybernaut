<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeeleaverequests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('employee_id');
            $table->json('employeeleave_id');
            $table->date('start');
            $table->date('end');
            $table->enum('status', ['none', 'pending', 'approved', 'rejected'])->default('none');
            $table->integer('approval_1')->nullable(); // 1 hod, 2 hrd, 3 gm
            $table->integer('approval_2')->nullable(); // 1 hod, 2 hrd, 3 gm
            $table->integer('approval_3')->nullable(); // 1 hod, 2 hrd, 3 gm

        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeleaverequests');
    }
};
