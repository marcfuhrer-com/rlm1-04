<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('accesses', function (Blueprint $table) {
            $table->dropForeign('accesses_publisher_data_id_foreign');
            $table->dropIndex('accesses_publisher_data_id_index');
            $table->dropColumn('publisher_data_id');
            $table->string('publisher_data_name');
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
