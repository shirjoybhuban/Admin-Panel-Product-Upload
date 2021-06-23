<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_deals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('user_type');
            $table->string('title');
            $table->string('slug');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('status')->default(0);
            $table->integer('featured')->default(0);
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
        Schema::dropIfExists('flash_deals');
    }
}
