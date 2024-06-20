<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('name_product', 120);
            $table->string('descr_product', 255)->nullable();
            $table->string('img_product', 120)->nullable();
            $table->decimal('price_productlj', 8, 2);
            $table->decimal('price_productfds', 8, 2);
            $table->integer('stock_product');
            $table->integer('guests_product');
            $table->string('icon_product', 50)->nullable();
            $table->integer('status_product');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id_category')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories')->onDelete('set null');
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
};
