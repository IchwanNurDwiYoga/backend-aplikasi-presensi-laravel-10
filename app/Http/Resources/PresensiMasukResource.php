<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresensiMasukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_presensi' => $this->kode_presensi,
            'lat_masuk' => $this->lat_masuk,
            'long_masuk' => $this->long_masuk,
            'long_masuk' => $this->long_masuk,
            'updated_at' => $this->updated_at,
            'pegawai' => $this->whenLoaded('pegaweai')
        ];
    }
}
