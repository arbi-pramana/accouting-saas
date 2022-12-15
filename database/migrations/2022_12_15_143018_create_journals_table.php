<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coa_id')->nullable();
            $table->string('description')->length(255)->nullable();
            $table->decimal('debit')->nullable();
            $table->decimal('credit')->nullable();
            $table->bigInteger('reference_id')->nullable();
            $table->string('type')->length(255)->nullable();
            $table->bigInteger('create_by')->nullable();
            $table->string('remarks')->length(255)->nullable();
            $table->timestamps();
        });
    }
            
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
