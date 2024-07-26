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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('id_client');
            $table->string('district_id');
            $table->string('document_id');
            $table->string('number_doc');
            $table->string('lastname_client');
            $table->string('name_client');
            $table->string('email_client');
            $table->string('phone_client');
            $table->string('password_client');
            $table->timestamps();
        
            // Definir la clave foránea
            $table->foreign('document_id')->references('id_doc')->on('sunat_typedoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
