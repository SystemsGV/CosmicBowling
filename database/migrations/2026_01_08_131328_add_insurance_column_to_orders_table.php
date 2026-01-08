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
        Schema::table('order', function (Blueprint $table) {
            $table->boolean('insurance')->default(0)->after('amount');
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->boolean('insurance')->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('insurance');
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('insurance');
        });
    }
};
