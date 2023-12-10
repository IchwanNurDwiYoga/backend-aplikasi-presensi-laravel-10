<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'kode_presensi'
        ,'jumlah_pegawai'
        ,'jumlah_pegawai_masuk'
        ,'jumlah_pegawai_pulang'
        ,'jumlah_izin'
        ,'total_izin'
        ,'tgl_presensi'
    ];

    /**
     * Get all of the presensiDetails for the Presensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presensiDetails()
    {
        return $this->hasMany(PresensiDetail::class, 'kode_presensi', 'kode_presensi');
    }
}
