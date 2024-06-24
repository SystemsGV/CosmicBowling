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
            $table->id('id_coupon');
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

        Schema::create('subcategory_coupon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('coupon_id')->references('id_coupon')->on('coupons')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories')->onDelete('cascade');

            // Evitar duplicados
            $table->unique(['coupon_id', 'subcategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_coupon');
        Schema::dropIfExists('coupons');
    }
};
