<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPageListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users_page_list'))
        {
            Schema::create('users_page_list', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('page_list_id');
                $table->foreign('page_list_id')->references('id')->on('page_lists');
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
        Schema::dropIfExists('users_page_list');
    }
}
