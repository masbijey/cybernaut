<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('employeeleaves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->integer('employee_id');
            $table->string('type'); //ph,al,eo
            $table->date('valid_until'); // tanggal berlaku
            $table->date('pick_date')->nullable(); 
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeleaves');
    }
};
