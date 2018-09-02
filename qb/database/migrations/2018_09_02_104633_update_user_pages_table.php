<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_pages', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->boolean('allowed_view');
            $table->boolean('allowed_add');
            $table->boolean('allowed_update');
            $table->boolean('allowed_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
