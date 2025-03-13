<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // テーブルが存在する場合はスキップ
        if (!Schema::hasTable('curriculum_progress')) {
            Schema::create('curriculum_progress', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('curriculumus_id');
                $table->integer('users_id');
                $table->tinyInteger('clear_flg')->default(0);
                $table->timestamps();
            });
        }
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
}
