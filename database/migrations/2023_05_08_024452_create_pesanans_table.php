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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            // $table->integer('users_id')->constrained();
            // $table->integer('menus_id')->constrained();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('menu_id');
            // $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreignId('users_id')->references('id')->on('users')->constrained();
            $table->foreignId('menus_id')->references('id')->on('menus')->constrained();
            $table->dateTime('tanggal_pesanan');
            // $table->date('tanggal_pesanan');
            $table->biginteger('jumlah_pesanan');
            $table->text('deskripsi_pesanan')->nullable()->default(0);
            $table->biginteger('total');
            $table->string('bukti')->nullable();
            $table->string('status')->nullable()->default('pembayaran');
            $table->string('laba');
            $table->timestamps();
        });
    }
   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
