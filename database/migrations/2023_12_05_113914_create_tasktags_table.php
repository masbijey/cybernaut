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
        Schema::create('tasktags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('task_id');
            $table->integer('location_id')->nullable();
            $table->integer('asset_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasktags');
    }
};
