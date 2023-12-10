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
        Schema::create('presensi_details', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_presensi');
            $table->string('kode_presensi');
            $table->string('nip');
            $table->string('presensi_masuk')->nullable();
            $table->integer('status_masuk')->nullable();
            $table->string('lat_masuk')->nullable();
            $table->string('long_masuk')->nullable();
            $table->string('presensi_pulang')->nullable();
            $table->integer('status_pulang')->nullable();
            $table->string('lat_pulang')->nullable();
            $table->string('long_pulang')->nullable();
            $table->string('izin')->nullable();
            $table->integer('status_izin')->nullable();
            $table->longText('alasan')->nullable();
            $table->string('bukti_izin')->nullable();
            $table->timestamps();

            $table->foreign('kode_presensi')->references('kode_presensi')->on('presensis')->onDelete('restrict');
            $table->foreign('nip')->references('nip')->on('pegawais')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_details');
    }
};
