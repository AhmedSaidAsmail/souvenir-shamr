<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('section_details');
    }
}
