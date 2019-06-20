<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditPaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_id');
            $table->string('public_key');
            $table->string('private_key');
            $table->boolean('ssl');
            $table->boolean('sandbox')->default(1);
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
        Schema::dropIfExists('credit_payment_gateways');
    }
}
