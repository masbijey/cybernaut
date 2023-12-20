<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('task_id')->nullable();
            $table->integer('workorder_id')->nullable();
            $table->string('file');
            $table->text('remark')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
