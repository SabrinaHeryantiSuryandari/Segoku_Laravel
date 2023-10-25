<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prediksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menus_id')->references('id')->on('menus')->constrained();
            $table->string('bulan');
            $table->biginteger('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediksi_penjualans');
    }
};
