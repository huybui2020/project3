<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->timestamps();
            $table->integer('catalog_id')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('product_name')->nullable();
            $table->text('content')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('discount')->nullable();
            $table->string('product_views')->default(0);
            $table->string('product_temp_slug')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
