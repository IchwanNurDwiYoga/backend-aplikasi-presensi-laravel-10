<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiDetail extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    /**
     * Get all of the Pegawai for the PresensiDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Pegawai()
    {
        return $this->hasMany(Pegawai::class, 'nip', 'nip');
    }
}
