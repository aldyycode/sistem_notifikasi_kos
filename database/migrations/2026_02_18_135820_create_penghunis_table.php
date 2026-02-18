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
      Schema::create('penghunis', function (Blueprint $table) {
    $table->id('id_penghuni');
    $table->foreignId('id_pengelola')->constrained('pengelolas', 'id_pengelola');
    $table->string('nama_penghuni');
    $table->string('nomor_kamar');
    $table->string('no_wa');
    $table->string('status_hunian');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghunis');
    }
};
