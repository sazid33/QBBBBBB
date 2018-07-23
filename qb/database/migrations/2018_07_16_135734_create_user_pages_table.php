<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_pages'))
        {
            Schema::create('user_pages', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('page_id');
                $table->foreign('page_id')->references('id')->on('pages');
                $table->boolean('is_active');
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
        Schema::dropIfExists('user_pages');
    }
}
