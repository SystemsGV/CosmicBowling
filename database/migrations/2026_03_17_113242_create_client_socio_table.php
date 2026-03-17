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
     public function up(): void
    {
        Schema::create('client_socio', function (Blueprint $table) {
            $table->id();

            // FK a clients
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                  ->references('id_client')
                  ->on('clients')
                  ->onDelete('cascade');

            // Número de tarjeta (string porque lleva ceros adelante ej: 00000123)
            $table->string('nTarjNumb', 20)->unique();

            // Activo/Inactivo
            $table->tinyInteger('cTarjActi')->default(1);

            // Fechas de emisión y caducidad
            $table->date('dEmisDate')->nullable();
            $table->date('dCaduDate')->nullable();

            // Verificación de correo (0 no verificado, 1 verificado)
            $table->tinyInteger('validado')->default(0);

            // Ficha de afiliación / comprobante de pago
            $table->string('affiliation')->nullable();

            // Número mágico (de referencia interna)
            $table->integer('status_magic')->default(0);

            // Usuarios que gestionan el registro
            $table->string('user_new')->nullable();
            $table->string('user_renew')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_socio');
    }
};
