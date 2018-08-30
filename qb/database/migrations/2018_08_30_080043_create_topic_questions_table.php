<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('topic_questions'))
        {
            Schema::create('topic_questions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id', true);
                $table->integer('topic_id');
                $table->foreign('topic_id')->references('id')->on('topics');
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
        Schema::dropIfExists('topic_questions');
    }
}
