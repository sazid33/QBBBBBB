<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('subjects'))
        {
            Schema::create('subjects', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id', true);
                $table->string('name');
                $table->integer('company_id');
                $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('subjects');
    }
}
