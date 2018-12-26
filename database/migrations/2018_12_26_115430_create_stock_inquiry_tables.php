<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInquiryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_inquiry_header', function (Blueprint $table) {
            $table->string('document_number', 50)->primary();
            $table->string('created_by_username', 100); //  do not create foreign key to avoid cascade deletes
            $table->text('purpose')->nullable();
            $table->timestamps();

            $table->foreign('created_by_username')->references('username')->on('users');
        });

        Schema::create('stock_inquiry_details', function (Blueprint $table) {
            $table->string('document_number', 50);
            $table->string('item_code', 50);
            $table->integer('needed_quantity')->default(1)->unsigned();
            $table->integer('on_hand_quantity')->default(0)->unsigned();
            $table->string('supplier_id', 50)->nullable();
            $table->integer('supplier_quantity')->default(0)->unsigned();
            $table->decimal('supplier_unit_cost', 7, 2)->default(0)->unsigned();
            $table->timestamps();

            $table->primary(['document_number', 'item_code']);
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
        Schema::dropIfExists('stock_inquiry_details');
        Schema::dropIfExists('stock_inquiry_header');
    }
}
