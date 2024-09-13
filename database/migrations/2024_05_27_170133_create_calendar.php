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
            $table->unsignedBigInteger('user_id');
            $table->string('name_calendar');
            $table->decimal('price_calendar', 8, 2);
            $table->string('extent_calendar');
            $table->string('quantity_calendar');
            $table->dateTime('start_calendar');
            $table->dateTime('end_calendar');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
};
