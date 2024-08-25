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
        Schema::create('roomcheck', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('roomlist_id');
            $table->integer('roomcomponent_id');
            $table->string('cleanliness_score');
            $table->string('condition_score');
            $table->string('photo1');
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomcheck');
    }
};
