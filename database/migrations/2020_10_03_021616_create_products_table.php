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
            $table->string('name');
            $table->string('slug');
            $table->integer('quantity');
            $table->double('price');
            $table->double('discount')->default(0);
            $table->longText('description')->default("");
            $table->string('image')->nullable();
            $table->string('image_small')->nullable();
            $table->string('image_large')->nullable();
            $table->double('min_order')->default(1);
            $table->string('type')->nullable();
            $table->boolean('in_highlight')->nullable();
            $table->boolean('is_special_product')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('categories')->nullable();
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
