<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('code', 50)->primary();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
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
    }
}
