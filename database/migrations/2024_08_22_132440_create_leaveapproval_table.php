<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaveapproval', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('work_date');
            $table->string('remark');
            $table->integer('approved_1_by')->nullable();
            $table->timestamp('approved_1_at')->nullable();
            $table->string('approved_1_status')->nullable();
            $table->integer('approved_2_by')->nullable();
            $table->timestamp('approved_2_at')->nullable();
            $table->string('approved_2_status')->nullable();
            $table->integer('approved_3_by')->nullable();
            $table->timestamp('approved_3_at')->nullable();
            $table->string('approved_3_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaveapproval');
    }
};
