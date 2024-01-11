<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employeetrainings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('user_id')->default(0);

            $table->datetime('start');
            $table->datetime('end');
            $table->time('duration');
            $table->string('trainer');
            $table->text('description');
            $table->string('venue');
            $table->string('file');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('employeetrainings');
    }
};
