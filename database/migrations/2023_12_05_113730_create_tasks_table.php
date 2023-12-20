<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('employee_id');
            $table->string('task_title');
            $table->text('task_desc');
            $table->string('task_status')->nullable();
            $table->string('task_type');
            $table->date('task_date');
            $table->string('task_price')->nullable();
            $table->text('task_remark')->nullable();
            $table->string('task_priority');
            $table->string('task_vendor')->nullable();
            $table->string('task_vendor_phone')->nullable();
            $table->integer('workorder_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
