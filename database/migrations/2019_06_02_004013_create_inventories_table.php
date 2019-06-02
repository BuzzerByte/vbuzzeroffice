<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('model_no')->nullable();
            $table->string('in_house')->nullable();
            $table->string('image')->nullable();
            $table->float('s_price')->nullable();
            $table->string('s_information')->nullable();
            $table->float('p_price')->nullable();
            $table->string('p_information')->nullable();
            $table->string('quantity')->nullable();
            $table->string('type')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('tax_id')->unsigned()->nullable();
            $table->timestamps();

            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
