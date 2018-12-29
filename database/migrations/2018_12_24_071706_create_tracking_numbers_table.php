<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_numbers', function (Blueprint $table) {
            $table->string('code', 20)->primary();
            $table->string('module_code', 20);   
            $table->boolean('is_active')->default(true);
            $table->integer('starting_number')->default(0)->unsigned();
            $table->integer('ending_number')->default(99999999)->unsigned();
            $table->integer('current_number')->default(0)->unsigned();
            $table->boolean('is_reseting_every_year')->default(false);
            $table->timestamps();

            $table->foreign('module_code')->references('code')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_numbers');
    }
}
