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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id',10);
            $table->string('name', 255);
            $table->string('name_kana', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('profile_image', 255);
            $table->integer('grade_id');
            $table->timestamps();

            // マイグレーション実行のために一時コメントアウト。
            // gradesテーブルをpullできた後でコメントアウトは解除。
            // $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
