<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('product_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('create_by')->nullable();
			$table->string('remarks', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('product_categories');
	}
}