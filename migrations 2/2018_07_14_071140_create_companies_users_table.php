<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('companies_users'))
        {
            Schema::create('companies_users', function (Blueprint $table) {
                $table->engine = 'INNODB';
                $table->integer('id',true);
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
        Schema::dropIfExists('companies_users');
    }
}
