<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('has_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('has_roles', function (Blueprint $table) {
            $table->dropForeign('has_roles_role_id_foreign');
            $table->dropIndex('has_roles_role_id_index');
            $table->dropColumn('role_id');
            $table->dropForeign('has_roles_user_id_foreign');
            $table->dropIndex('has_roles_user_id_index');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('has_roles');
    }
}
