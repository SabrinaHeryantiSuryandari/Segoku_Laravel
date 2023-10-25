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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            // $table->string('gambar')->nullable()->default(null);
            // $table->string('nama_menu')->nullable()->default(null);
            // $table->text('deskripsi_menu')->nullable()->default(0);
            // $table->biginteger('harga')->nullable()->default(0);
            $table->string('image');
            $table->string('nama_menu');
            $table->text('deskripsi_menu');
            $table->biginteger('harga');
            $table->string('biaya_produksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
