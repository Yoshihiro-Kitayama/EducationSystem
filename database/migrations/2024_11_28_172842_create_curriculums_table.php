<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            // 外部キー作成のため InnoDB に指定
            $table->engine = 'InnoDB';

            $table->id(); // BIGINT UNSIGNED
            $table->string('title', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->longText('description')->nullable();
            $table->mediumText('video_url')->nullable();
            $table->tinyInteger('alway_delivery_flg');

            // grade_id の型を grades.id と合わせる
            $table->unsignedBigInteger('grade_id');

            $table->timestamps();

            // 外部キー
            $table->foreign('grade_id')
                  ->references('id')
                  ->on('grades')
                  ->onDelete('cascade'); // 親削除時に自動削除
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
};

