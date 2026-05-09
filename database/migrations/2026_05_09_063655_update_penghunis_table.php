<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penghunis', function (Blueprint $table) {

            if (!Schema::hasColumn('penghunis', 'gender')) {
                $table->enum('gender', ['L', 'P'])->nullable();
            }

            if (!Schema::hasColumn('penghunis', 'tanggal_masuk')) {
                $table->date('tanggal_masuk')->nullable();
            }

            if (!Schema::hasColumn('penghunis', 'status_hunian')) {
                $table->enum('status_hunian', ['aktif', 'nonaktif'])->default('aktif');
            }

            if (!Schema::hasColumn('penghunis', 'nama_kontak_darurat')) {
                $table->string('nama_kontak_darurat')->nullable();
            }

            if (!Schema::hasColumn('penghunis', 'no_kontak_darurat')) {
                $table->string('no_kontak_darurat')->nullable();
            }

        });
    }

    public function down()
    {
        Schema::table('penghunis', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'tanggal_masuk',
                'status_hunian',
                'nama_kontak_darurat',
                'no_kontak_darurat'
            ]);
        });
    }
};