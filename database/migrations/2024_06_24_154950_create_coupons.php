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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('id_cupon');
            $table->string('code')->unique(); // Código único del cupón
            $table->text('description')->nullable(); // Descripción del cupón
            $table->decimal('discount_amount', 8, 2)->nullable(); // Monto de descuento
            $table->enum('discount_type', ['fixed', 'percentage']); // Tipo de descuento
            $table->integer('usage_limit')->nullable(); // Límite de uso del cupón
            $table->integer('used_count')->default(0); // Conteo de veces usado
            $table->date('valid_from')->nullable(); // Fecha de inicio de validez
            $table->date('valid_until')->nullable(); // Fecha de fin de validez
            $table->boolean('is_active')->default(true); // Si el cupón está activo
            $table->timestamps(); // Timestamps de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
