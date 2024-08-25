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
            $table->integer('user_id');
            $table->string('type');
            $table->date('valid_until'); 
            $table->string('pick_date')->nullable(); 
            $table->text('description')->nullable();
            $table->integer('leaveapproval_id')->nullable();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeeleaves');
    }
};
