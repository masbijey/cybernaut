<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeeattendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('employee_id');
            $table->date('date');
            $table->time('sch_checkin');
            $table->time('sch_checkout');
            $table->time('checkin');
            $table->time('checkout');
            $table->integer('leave_id');
            $table->string('paidable');
            $table->time('late_checkin');
            $table->time('early_checkout');
            $table->text('remark');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeattendances');
    }
};
