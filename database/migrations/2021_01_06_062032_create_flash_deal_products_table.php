<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashDealProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_deal_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('flash_deal_id');
            $table->foreignId('product_id');
            $table->double('discount');
            $table->string('user_type');
            $table->string('discount_type');
            $table->timestamps();
            $table->foreign('flash_deal_id')->references('id')->on('flash_deals')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flash_deal_products');
    }
}
