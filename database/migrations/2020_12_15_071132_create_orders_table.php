<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->longText('shipping_address')->nullable();
            $table->bigInteger('shop_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('ssl_status')->nullable();
            $table->string('currency')->nullable();
            $table->string('amount_after_getaway_fee')->nullable();
            $table->longText('payment_details')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('invoice_code')->nullable();
            $table->string('grand_total')->nullable();
            $table->integer('discount')->nullable();
            $table->double('commission_calculated')->nullable();
            $table->string('delivery_cost')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('type')->nullable();
            $table->string('view');
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
        Schema::dropIfExists('orders');
    }
}
