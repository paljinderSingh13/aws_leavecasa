<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsMarkupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights_markups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flight_number');
            $table->string('airline');
            $table->string('location_from');
            $table->string('location_to');
            $table->double('plus_amount');
            $table->double('plus_percent');
            $table->boolean('visibility_status');
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
        Schema::dropIfExists('flights_markups');
    }
}
