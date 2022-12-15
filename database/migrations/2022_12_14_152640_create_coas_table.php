<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coas', function (Blueprint $table) {
            $table->id();
            $table->string('coa')->length(255)->nullable();
            $table->string('category_1')->length(255)->nullable();
            $table->string('category_2')->length(255)->nullable();
            $table->string('name')->length(255)->nullable();
            $table->decimal('opening_balance_db')->length(20,2)->nullable();
            $table->decimal('opening_balance_cr')->length(20,2)->nullable();
            $table->decimal('total_opening_balance')->length(20,2)->nullable();
            $table->date('date')->nullable();
            $table->string('create_by')->integer(10)->nullable();
            $table->string('remarks')->varchar(255)->nullable();
            $table->integer('is_locked')->length(20)->nullable();
            $table->timestamps();
        });
    }
            
    public function down()
    {
        Schema::dropIfExists('coas');
    }
}
