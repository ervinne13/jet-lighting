<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ledger', function (Blueprint $table) {
            $table->dateTime('entry_date_time')->useCurrent()->primary();
            $table->string('item_code', 50);
            $table->decimal('unit_cost', 7, 2)->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('remaining_quantity')->unsigned();            
            $table->string('ref_document_number', 50)->nullable();

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
        Schema::dropIfExists('item_ledger');
    }
}
