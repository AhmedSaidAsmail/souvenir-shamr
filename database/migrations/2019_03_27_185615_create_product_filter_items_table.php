<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFilterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_filter_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//            $table->integer('filter_id')->unsigned();
//            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
            $table->integer('filter_item_id')->unsigned();
            $table->foreign('filter_item_id')->references('id')->on('filter_items')->onDelete('cascade');
            $table->unique(['product_id','filter_item_id']);
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
        Schema::dropIfExists('product_filter_items');
    }
}
