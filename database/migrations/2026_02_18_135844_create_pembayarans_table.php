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
      Schema::create('pembayarans', function (Blueprint $table) {
    $table->id('id_pembayaran');
    $table->foreignId('id_penghuni')->constrained('penghunis', 'id_penghuni');
    $table->decimal('jumlah_bayar', 12, 2);
    $table->date('jatuh_tempo');
    $table->date('tanggal_bayar')->nullable();
    $table->enum('status_bayar', ['lunas','belum_lunas'])->default('belum_lunas');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
