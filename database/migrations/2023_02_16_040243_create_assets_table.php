<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('token');
            $table->string('name');
            $table->integer('category_id');
            $table->string('vendorName');
            $table->string('vendorPhone');
            $table->string('vendorAddress');
            $table->string('merk');
            $table->string('type');
            $table->string('serialNumber');
            $table->date('buyDate');
            $table->string('buyPrice');
            $table->datetime('lastProject')->nullable();
            $table->datetime('lastCheck')->nullable();
            $table->datetime('lastMaintenance')->nullable();
            $table->text('remark')->nullable();
            $table->string('file');
            $table->string('buyCond');
            
            $table->integer('created_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
};
