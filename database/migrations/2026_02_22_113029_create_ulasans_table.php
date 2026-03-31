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
Schema::create('ulasans', function (Blueprint $table) {
    $table->id('id_ulasan');

    $table->foreignId('id_pembayaran')
          ->constrained('pembayarans', 'id_pembayaran')
          ->onDelete('cascade');

    $table->foreignId('id_penghuni')
          ->constrained('penghunis', 'id_penghuni')
          ->onDelete('cascade');

    $table->text('isi_ulasan');
    $table->integer('nilai_rating');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
