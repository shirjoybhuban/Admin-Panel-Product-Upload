<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aPId_to_seller')->nullable();
            $table->string('name');
            $table->string('added_by');
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->foreignId('subsubcategory_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->string('photos')->nullable();
            $table->string('thumbnail_img')->nullable();
            $table->string('video_link')->nullable();
            $table->longText('description')->nullable();
            $table->double('unit_price');
            $table->double('purchase_price');
            $table->integer('variant_product');
            $table->string('attributes');
            $table->mediumText('choice_options')->nullable();
            $table->mediumText('colors')->nullable();
            $table->text('variations')->nullable();
            $table->integer('todays_deal');
            $table->integer('published');
            $table->integer('featured');
            $table->integer('num_of_sale')->default(0);
            $table->integer('current_stock');
            $table->string('unit')->nullable();
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->mediumText('slug')->nullable();
            $table->double('rating')->nullable();
            $table->integer('digital')->nullable();
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
        Schema::dropIfExists('products');
    }
}
