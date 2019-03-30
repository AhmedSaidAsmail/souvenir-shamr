<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFilterItemGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_filter_item_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_filter_item_id')->unsigned();
            $table->foreign('product_filter_item_id')->references('id')->on('product_filter_items')->onDelete('cascade');
            $table->string('image');
            $table->integer('sort_order')->default(0);
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
        Schema::dropIfExists('product_filter_item_galleries');
    }
}
