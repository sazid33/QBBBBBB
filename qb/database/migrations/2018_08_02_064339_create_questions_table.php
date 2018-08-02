<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('questions'))
        {
            Schema::create('questions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('question_type_id');
                $table->foreign('question_type_id')->references('id')->on('question_types');
                $table->string('text');
                $table->integer('priority');
                $table->integer('difficulty');
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
        Schema::dropIfExists('questions');
    }
}
