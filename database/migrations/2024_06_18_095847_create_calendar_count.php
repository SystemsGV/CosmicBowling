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
        Schema::create('calendar_intervals', function (Blueprint $table) {
            $table->id('id_citem');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('calendar_id');
            $table->date('date_citem');
            $table->time('time_interval');  // Campo para almacenar el intervalo de tiempo específico
            $table->integer('available_quantity');  // Cantidad disponible para el intervalo de tiempo
            $table->decimal('price_citem', 8, 2);

            // Añadir claves foráneas si es necesario
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories')->onDelete('cascade');
            $table->foreign('calendar_id')->references('id_calendar')->on('calendar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_intervals');
    }
};
