<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('en_meta_title');
            $table->string('ar_meta_title');
            $table->string('it_meta_title');
            $table->string('ru_meta_title');
            $table->string('en_meta_keywords');
            $table->string('ar_meta_keywords');
            $table->string('it_meta_keywords');
            $table->string('ru_meta_keywords');
            $table->string('en_meta_description');
            $table->string('ar_meta_description');
            $table->string('it_meta_description');
            $table->string('ru_meta_description');
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
        Schema::dropIfExists('product_meta_tags');
    }
}
