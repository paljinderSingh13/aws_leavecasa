<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsMarkupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels_markups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('country_code');
            $table->string('city');
            $table->string('city_code');
            $table->string('destination');
            $table->string('amount_by');
            $table->double('amount');
            $table->boolean('visibility');
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
        Schema::dropIfExists('hotels_markups');
    }
}
