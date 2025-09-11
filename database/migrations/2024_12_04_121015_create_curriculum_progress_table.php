<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('curriculum_progress', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // 外部キー作成用

            $table->id();
            
            // users.id と型を合わせる
            $table->unsignedBigInteger('users_id'); 
            
            // curriculums.id と型を合わせる
            $table->unsignedBigInteger('curriculums_id'); 
            
            $table->tinyInteger('progress_status')->default(0); 
            $table->timestamps();

            // 外部キー
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('curriculums_id')
                  ->references('id')
                  ->on('curriculums')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_progress');
    }
};
