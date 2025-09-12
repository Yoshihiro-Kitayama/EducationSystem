<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // 外部キー用

            $table->id();
            
            // curriculums.id と型を合わせる
            $table->unsignedBigInteger('curriculums_id');

            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            // 外部キー
            $table->foreign('curriculums_id')
                  ->references('id')
                  ->on('curriculums')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_times');
    }
};
