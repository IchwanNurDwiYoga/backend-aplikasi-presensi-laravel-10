<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresensiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'pesan'=>'Sukses',
            'kode_presensi'=>$this->kode_presensi,
            'tgl_presensi' =>$this->tgl_presensi,
        ];
    }
}
