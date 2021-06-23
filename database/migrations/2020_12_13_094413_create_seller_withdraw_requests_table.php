<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerWithdrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->double('amount')->nullable();
            $table->longText('message')->nullable();
            $table->integer('status')->nullable();
            $table->integer('viewed')->nullable();
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
        Schema::dropIfExists('seller_withdraw_requests');
    }
}
