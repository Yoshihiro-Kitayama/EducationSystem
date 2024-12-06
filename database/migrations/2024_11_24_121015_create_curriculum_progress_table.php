<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_progress', function (Blueprint $table) {
            $table->integer('id',10);
            $table->integer('curriculumus_id');
            $table->integer('users_id');
            $table->tinyInteger('clear_flg')->default(0);
            $table->timestamps();

            // マイグレーション実行のために一時コメントアウト。
            // curriculumsテーブルをpullできた後でコメントアウトは解除。
            // $table->foreign('curriculumus_id')->references('id')->on('curriculums');

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_progress');
    }
};
