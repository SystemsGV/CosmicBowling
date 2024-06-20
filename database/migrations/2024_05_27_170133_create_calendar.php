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
        Schema::create('calendar', function (Blueprint $table) {
            $table->id('id_calendar');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('name_calendar');
            $table->string('extent_calendar');
            $table->dateTime('start_calendar');
            $table->dateTime('end_calendar');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories')->onDelete('cascade');
        });

        Schema::create('calendar_items', function (Blueprint $table) {
            $table->id('id_citem');
            $table->unsignedBigInteger('subcategory_id_citem');
            $table->unsignedBigInteger('calendar_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('hour_citem');
            $table->integer('date_citem');
            $table->decimal('price_citem', 8, 2);
            $table->integer('status_citem')->default(1);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('subcategory_id_citem')->references('id_subcategory')->on('subcategories')->onDelete('cascade');
            $table->foreign('calendar_id')->references('id_calendar')->on('calendar')->onDelete('cascade');
            $table->foreign('product_id')->references('id_product')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_items');
        Schema::dropIfExists('calendar');
    }
};
