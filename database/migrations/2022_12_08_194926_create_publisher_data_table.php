<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_data', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->timestamps();
            $table->unsignedBigInteger('building_id')->unsigned()->index();
            $table->foreign('building_id')->references('id')->on('building')->onDelete('cascade');
            $table->unsignedBigInteger('floor_id')->unsigned()->index();
            $table->foreign('floor_id')->references('id')->on('floor')->onDelete('cascade');
            $table->json('view');
            $table->string('ip_range');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publisher_data', function (Blueprint $table) {
            $table->dropForeign('publisher_data_building_id_foreign');
            $table->dropIndex('publisher_data_building_id_index');
            $table->dropColumn('building_id');
            $table->dropForeign('publisher_data_floor_id_foreign');
            $table->dropIndex('publisher_data_floor_id_index');
            $table->dropColumn('floor_id');
        });
        Schema::dropIfExists('publisher_data');
    }
}
