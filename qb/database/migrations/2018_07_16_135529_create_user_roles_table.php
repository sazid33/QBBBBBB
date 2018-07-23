<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_roles'))
        {
            Schema::create('user_roles', function (Blueprint $table) {
                $table->engine = 'INNODB';
                $table->integer('id',true);
                $table->integer('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('role_id');
                $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('user_roles');
    }
}
