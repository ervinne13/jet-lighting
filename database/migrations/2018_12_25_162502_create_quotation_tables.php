<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_headers', function (Blueprint $table) {
            $table->string('document_number', 50)->primary();
            $table->string('name', 100);
            $table->text('address');
            $table->string('contact_person', 100);
            $table->string('contact_number', 20);
            $table->string('email_address', 100);
            $table->string('ref_client_tracking_number', 50)->nullable();
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
        Schema::dropIfExists('quotation_headers');
    }
}
