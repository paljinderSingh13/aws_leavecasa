<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdminSubaminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_subadmin_users', function($table){
            $table->unsignedInteger('role_id')->index()->after('password');
            $table->boolean('is_whitelist')->after('role_id');
            $table->double('contact_no')->after('is_whitelist');
            $table->text('address')->after('contact_no');
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
        Schema::table('admin_subadmin_users', function($table){
            $table->drop('role_id');
            $table->drop('is_whitelist');
            $table->drop('contact_no');
            $table->drop('address');
        });
    }
}
