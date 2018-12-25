<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });

        Schema::create('role_accessible_modules', function (Blueprint $table) {
            $table->integer('role_id')->unsigned(); 
            $table->string('module_code', 100);
            $table->string('access_control', 20)->default('viewer');

            $table->primary(['role_id', 'module_code']);
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('role_accessible_modules');
        Schema::dropIfExists('roles');
    }
}
