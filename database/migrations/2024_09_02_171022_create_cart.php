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
        Schema::create('cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('client_id'); // ID del cliente que realiza el pedido
            $table->unsignedBigInteger('subcategory_id'); // ID de la subcategoría
            $table->unsignedBigInteger('coupon_id')->nullable(); // ID del cupón, puede ser nulo
            $table->string('reservation_code')->unique(); // Código de reserva único
            $table->string('description'); // Código de reserva único
            $table->date('date_reserved');
            $table->time('hour_init');
            $table->integer('quantity_lane');
            $table->integer('quantity_hours');
            $table->integer('quantity_guests');
            $table->string('payment_type')->default('2');
            $table->decimal('amount_discount', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->string('document_type'); // Tipo de documento: 'B' para Boleta, 'F' para Factura
            $table->string('rsocial')->nullable(); // Razón social (solo para factura)
            $table->string('ruc')->nullable(); // RUC (solo para factura)
            $table->string('dir')->nullable(); // Dirección (solo para factura)
            $table->string('observation_client')->nullable(); // Dirección (solo para factura)
            $table->string('status');
            $table->timestamps();

            // Relaciones con otras tablas
            $table->foreign('order_id')->references('id_order')->on('order');
            $table->foreign('client_id')->references('id_client')->on('clients');
            $table->foreign('subcategory_id')->references('id_subcategory')->on('subcategories');
            $table->foreign('coupon_id')->references('id_coupon')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
