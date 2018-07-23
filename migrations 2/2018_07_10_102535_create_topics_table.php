<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('topics'))
        {
            Schema::create('topics', function (Blueprint $table) {
                $table->engine = 'INNODB';
                $table->integer('id',true);
                $table->string('name');
                $table->integer('chapter_id');
                $table->foreign('chapter_id')->references('id')->on('chapters');
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
        Schema::dropIfExists('topics');
    }
}
