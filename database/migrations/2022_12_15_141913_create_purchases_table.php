<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->date('date')->nullable();
        $table->string('type')->length(255)->nullable();
        $table->bigInteger('supplier_id')->nullable();
        $table->bigInteger('product_id')->nullable();
        $table->decimal('quantity')->length(20,2)->nullable();
        $table->decimal('price')->length(20,2)->nullable();
        $table->decimal('subtotal')->length(20,2)->nullable();
        $table->integer('tax_percentage')->nullable();
        $table->integer('tax_amount')->nullable();
        $table->decimal('total')->length(20,2)->nullable();
        $table->decimal('payment_amount')->length(20,2)->nullable();
        $table->bigInteger('coa_id')->nullable();
        $table->bigInteger('create_by')->nullable();
        $table->string('remarks')->length(255)->nullable();
        $table->timestamps();
    });
}
        
public function down()
{
    Schema::dropIfExists('purchases');
}
}
