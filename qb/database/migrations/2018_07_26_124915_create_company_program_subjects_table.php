<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProgramSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('company_program_subjects'))
        {
            Schema::create('company_program_subjects', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id',true);
                $table->integer('company_program_id');
                $table->foreign('company_program_id')->references('id')->on('company_programs');
                $table->integer('subject_id');
                $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('company_program_subjects');
    }
}
