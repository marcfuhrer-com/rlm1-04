<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('building_id')->unsigned()->index();
            $table->foreign('building_id')->references('id')->on('building')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('floor', function (Blueprint $table) {
            $table->dropForeign('floor_building_id_foreign');
            $table->dropIndex('floor_building_id_index');
            $table->dropColumn('building_id');
        });
        Schema::dropIfExists('floor');
    }
}
