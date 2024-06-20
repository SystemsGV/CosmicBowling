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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('name_category', 120);
            $table->string('descr_category', 150)->nullable();
            $table->string('img_category', 120)->nullable();
            $table->integer('status_category');
            $table->timestamps();
        });

        Schema::create('subcategories', function (Blueprint $table) {
            $table->id('id_subcategory');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id_category')->on('categories')->onDelete('cascade');
            $table->string('name_subcategory', 120);
            $table->string('descr_subcategory', 150)->nullable();
            $table->time('time_init')->nullable();
            $table->time('time_finish')->nullable();
            $table->string('img_subcategory', 120)->nullable();
            $table->string('color_subcategory', 30)->nullable();
            $table->string('extend_subcategory', 120);
            $table->integer('status_subcategory');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
        Schema::enableForeignKeyConstraints();
    }
};
