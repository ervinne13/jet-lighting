<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->string('code', 50)->primary();
            $table->integer('category_id')->unsigned();
            $table->string('name', 100);
            $table->string('image_url', 200);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('item_categories');
        });

        Schema::create('supplier_item_costs', function (Blueprint $table) {
            $table->string('supplier_id', 50);
            $table->string('item_code', 50);
            $table->decimal('last_purchased_unit_cost', 7, 2);
            $table->timestamps();

            $table->primary(['supplier_id', 'item_code']);
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('item_code')->references('code')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('supplier_item_costs');
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_categories');
    }
}
