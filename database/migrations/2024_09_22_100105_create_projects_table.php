<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable(); // Project owner
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('update_by')->nullable(); // done by user ?
            $table->enum('status', ['planning', 'ongoing', 'completed', 'on_hold', 'cancelled'])->default('planning');
            $table->decimal('budget', 10, 2)->nullable();
            $table->date('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
