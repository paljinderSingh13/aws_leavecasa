<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permission_for');
            $table->unsignedInteger('module_id')->index();
            $table->unsignedInteger('role_id')->index();
            $table->string('route_action');
            $table->boolean('permission');
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('modules')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('admin_user_roles')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
