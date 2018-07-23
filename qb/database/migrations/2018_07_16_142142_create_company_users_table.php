<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('company_users'))
        {
            Schema::create('company_users', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id', true);
                $table->integer('company_id');
                $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('company_users');
    }
}
