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
        Schema::create('presensis', function (Blueprint $table) {
            $table->string('kode_presensi')->primary();
            $table->integer('jumlah_pegawai');
            $table->integer('jumlah_pegawai_masuk')->nullable();
            $table->integer('jumlah_pegawai_pulang')->nullable();
            $table->integer('jumlah_izin')->nullable();
            $table->integer('total_izin')->nullable();
            $table->integer('total')->nullable();
            $table->string('tgl_presensi')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
