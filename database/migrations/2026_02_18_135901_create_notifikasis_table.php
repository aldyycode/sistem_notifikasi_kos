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
       Schema::create('notifikasis', function (Blueprint $table) {
    $table->id('id_notifikasi');
    $table->foreignId('id_pembayaran')->constrained('pembayarans', 'id_pembayaran');
    $table->text('isi_pesan');
    $table->dateTime('tanggal_kirim')->nullable();
    $table->enum('status_kirim', ['terkirim','gagal'])->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
