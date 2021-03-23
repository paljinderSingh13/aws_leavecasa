<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFlightsMarkupsAddColumnAmountBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flights_markups', function(Blueprint $table){
            $table->string('amount_by')->after('visibility_status')->default('percent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flights_markups', function(Blueprint $table){
            $table->drop('amount_by');
        });
    }
}
