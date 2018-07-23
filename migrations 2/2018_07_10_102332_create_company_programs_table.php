<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('company_programs'))
        {
            Schema::create('company_programs', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('id', true);
                $table->integer('company_id');
                $table->foreign('company_id')->references('id')->on('companies');
                $table->integer('program_id');
                $table->foreign('program_id')->references('id')->on('programs');
                $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('company_programs');
    }
}
