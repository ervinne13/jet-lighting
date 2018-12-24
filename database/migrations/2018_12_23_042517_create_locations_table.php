<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name', 100);
            $table->timestamps();
        });

        Schema::create('user_locations', function (Blueprint $table) {
            $table->string('username', 100); 
            $table->integer('location_id')->unsigned(); 
            $table->boolean('is_default')->default(false);

            $table->primary(['username', 'location_id']);
            $table->foreign('username')->references('username')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_locations');
        Schema::dropIfExists('locations');
    }
}
