<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration {

	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->string('address', 255)->nullable();
			$table->text('description')->nullable();
			$table->string('create_by', 255)->nullable();
			$table->string('remarks', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('suppliers');
	}
}