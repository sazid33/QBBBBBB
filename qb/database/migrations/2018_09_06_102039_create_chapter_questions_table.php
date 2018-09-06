<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('chapter_questions'))
        {
            Schema::create('chapter_questions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('chapter_id');
                $table->foreign('chapter_id')->references('id')->on('chapters');
                $table->integer('question_id');
                $table->foreign('question_id')->references('id')->on('questions');
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
        Schema::dropIfExists('chapter_questions');
    }
}
