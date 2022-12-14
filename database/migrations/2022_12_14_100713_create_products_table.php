<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('category_id');
			$table->string('unit', 255);
			$table->decimal('sell_price', 20,2);
			$table->decimal('purchase_price', 20,2);
			$table->decimal('opening_quantity', 20,2)->nullable();
			$table->integer('create_by')->nullable();
			$table->string('remarks', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}