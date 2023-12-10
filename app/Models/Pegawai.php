<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;



class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;
    protected $fillable = [
        'nip',
        'jabatan_id',
        'nama',
        'jenis_kelamin',
        'email', 'password', 'foto', 'is_active', 'role',  'created_at', 'updated_at',
        'deleted_at',
    ];

    /**
     * Get all of the jabatan for the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id', 'jabatan_id');
    }

    /**
     * Get all of the presensiDetails for the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presensiDetails()
    {
        return $this->hasMany(PresensiDetail::class, 'nip', 'nip');
    }
}
