<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('publisher_data_name')->index();
            $table->foreign('publisher_data_name')->references('name')->on('publisher_data')->onDelete('cascade');
            $table->boolean('creates');
            $table->boolean('reads');
            $table->boolean('updates');
            $table->boolean('deletes');
            $table->boolean('subscribes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accesses', function (Blueprint $table) {
            $table->dropForeign('accesses_user_id_foreign');
            $table->dropIndex('accesses_user_id_index');
            $table->dropColumn('user_id');
            $table->dropForeign('accesses_publisher_data_name_foreign');
            $table->dropIndex('accesses_publisher_data_name_index');
            $table->dropColumn('publisher_data_name');
        });
        Schema::dropIfExists('accesses');
    }
}
