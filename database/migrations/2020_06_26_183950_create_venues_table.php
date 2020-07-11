<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('event_id');
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->UnsignedBigInteger('country_id');
            $table->UnsignedBigInteger('state_id');
            $table->UnsignedBigInteger('city_id');
            $table->string('street_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('venues');
    }
}
