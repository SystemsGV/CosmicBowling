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
            $table->string('document_id');
            $table->string('number_doc')->unique();
            $table->string('lastname_pat');
            $table->string('lastname_mat');
            $table->string('names_client');
            $table->string('email_client')->unique();
            $table->string('phone_client');
            $table->date('birthday_client');
            $table->string('address_client');
            $table->string('password_client');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
